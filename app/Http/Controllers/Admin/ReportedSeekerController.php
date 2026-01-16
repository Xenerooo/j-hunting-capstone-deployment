<?php

namespace App\Http\Controllers\Admin;

use App\Models\Accounts;
use App\Models\JobSeeker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Report;

class ReportedSeekerController extends Controller
{
    //show all reported job seekers
    public function show(Request $request)
    {
        $seekerIDs = JobSeeker::where('is_reported', 1)
            ->pluck('seeker_id')
            ->toArray();

        if (empty($seekerIDs)) {
            return response()->json([
                'message' => 'No reported job seeker found.',
                'data' => [],
            ]);
        }

        $query = Report::with(['job_seeker'])
            ->whereIn('seeker_id', $seekerIDs);

        // Search filter
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->whereHas('job_seeker', function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere(DB::raw("CONCAT(first_name, ' ', last_name)"), 'like', "%{$search}%")
                    ->orWhere(DB::raw("CONCAT(first_name, ' ', mid_name, ' ', last_name)"), 'like', "%{$search}%");
            });
        }

        // Sorting
        if ($request->filled('sort')) {
            if ($request->sort === 'newest') {
                $query->orderByDesc('reported_at');
            } elseif ($request->sort === 'oldest') {
                $query->orderBy('reported_at');
            } else {
                $query->orderByDesc('reported_at');
            }
        } else {
            $query->orderByDesc('reported_at');
        }

        $results = $query->get();

        if ($results->isEmpty()) {
            return response()->json([
                'message' => 'No reported job seeker found.',
                'data' => [],
            ]);
        }

        return response()->json([
            'message' => 'Reported job seekers found.',
            'data' => $results,
        ]);
    }

    //view reported job seeker
    public function view($seeker_id)
    {
        $seeker = JobSeeker::find($seeker_id);

        return view('design.admin.view-seeker', compact('seeker'));
    }

    //ignore reported job seeker
    public function ignore(Request $request)
    {
        $report_id = $request->report_id;
        $seeker_id = $request->seeker_id;

        if (!$report_id) {
            return response()->json([
                'success' => false,
                'message' => 'Report ID is required.'
            ]);
        }

        if (!$seeker_id) {
            return response()->json([
                'success' => false,
                'message' => 'Job seeker ID is required.'
            ]);
        }

        $reported_seeker = JobSeeker::find($seeker_id);
        if (!$reported_seeker) {
            return response()->json([
                'success' => false,
                'message' => 'Job seeker not found.'
            ]);
        }

        $reported_seeker->is_reported = 0;
        $reported_seeker->save();

        $report_record = Report::where('report_id', $report_id)
            ->where('seeker_id', $seeker_id)
            ->first();

        if (!$report_record) {
            return response()->json([
                'success' => false,
                'message' => 'Report not found.'
            ]);
        }

        $report_record->delete();

        return response()->json([
            'success' => true,
            'message' => 'Report was ignored successfully.'
        ]);
    }
}
