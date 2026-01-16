<?php

namespace App\Http\Controllers\Admin;

use App\Models\Report;
use App\Models\Accounts;
use App\Models\Employer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ReportedEmployerController extends Controller
{
    //show all reported employers
    public function show(Request $request)
    {
        $employer_id = Employer::where('is_reported', 1)
            ->pluck('employer_id')
            ->toArray();

        if (empty($employer_id)) {
            return response()->json([
                'message' => 'No reported job seeker found.',
                'data' => [],
            ]);
        }

        $query = Report::with(['employer'])
            ->whereIn('employer_id', $employer_id);

        // Search filter
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->whereHas('employer', function ($q) use ($search) {
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

    //view profile data of employer
    public function view($employer_id)
    {
        $employer = Employer::where('employer_id', $employer_id)->firstOrFail();

        return view('design.admin.view-employer', compact('employer'));
    }

    //ignore reported job seeker
    public function ignore(Request $request)
    {
        $report_id = $request->report_id;
        $employer_id = $request->employer_id;

        if (!$report_id) {
            return response()->json([
                'success' => false,
                'message' => 'Report ID is required.'
            ]);
        }

        if (!$employer_id) {
            return response()->json([
                'success' => false,
                'message' => 'Employer ID is required.'
            ]);
        }

        $reported_employer = Employer::find($employer_id);
        if (!$reported_employer) {
            return response()->json([
                'success' => false,
                'message' => 'Employer not found.'
            ]);
        }

        $reported_employer->is_reported = 0;
        $reported_employer->save();

        $report_record = Report::where('report_id', $report_id)
            ->where('employer_id', $employer_id)
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
