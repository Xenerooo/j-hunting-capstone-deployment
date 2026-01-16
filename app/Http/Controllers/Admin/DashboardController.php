<?php

namespace App\Http\Controllers\Admin;

use App\Models\Job;
use App\Models\Accounts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RegistrationReportExport;

class DashboardController extends Controller
{
    //dashboard data
    function show()
    {
        $job_seeker = Accounts::where('user_type', 'job_seeker')->where('is_approved', 1)->count();
        $employer = Accounts::where('user_type', 'employer')->where('is_approved', 1)->count();
        $jobs = Job::where('status', 'accepted')->count();

        return response()->json([
            'success' => true,
            'job_seeker_total' => $job_seeker,
            'employer_total' => $employer,
            'jobs_total' => $jobs,
        ], 200);
    }

    //monthly registration
    function monthlyRegistration(Request $request)
    {
        $year = $request->input('year', date('Y'));
        $user_type = $request->input('user_type', 'all');

        $query = DB::table('accounts')
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->whereYear('created_at', $year)
            ->where('user_type', '!=', 'admin');;

        if ($user_type !== 'all') {
            $query->where('user_type', $user_type);
        }

        $data = $query->groupBy(DB::raw('MONTH(created_at)'))->pluck('total', 'month');

        $monthly_counts = [];
        for ($i = 1; $i <= 12; $i++) {
            $monthly_counts[] = $data[$i] ?? 0;
        }

        return response()->json([
            'labels' => [
                'Jan',
                'Feb',
                'Mar',
                'Apr',
                'May',
                'Jun',
                'Jul',
                'Aug',
                'Sep',
                'Oct',
                'Nov',
                'Dec'
            ],
            'data' => $monthly_counts
        ]);
    }

    //download registration excel
    function downloadRegistrationExcel(Request $request)
    {
        $year = $request->input('year', date('Y'));
        $type = $request->input('user_type', 'all');
        return Excel::download(new RegistrationReportExport($year, $type), "registration-report-{$year}.csv");
    }
}
