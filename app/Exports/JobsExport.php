<?php

namespace App\Exports;

use App\Models\Job;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class JobsExport implements FromView
{
    protected $month, $year, $sort;

    public function __construct($month, $year, $sort)
    {
        $this->month = $month;
        $this->year = $year;
        $this->sort = $sort;
    }

    public function view(): View
    {
        $query = Job::with('employer')
            ->whereMonth('created_at', date('m', strtotime($this->month)))
            ->whereYear('created_at', $this->year)->whereHas('employer', function ($q) {
                $q->where('status', 'accepted');
            });

        switch ($this->sort) {
            case 'newest':
                $query->orderByDesc('created_at');
                break;
            case 'oldest':
                $query->orderBy('created_at');
                break;
            case 'active':
                $query->whereHas('account', fn($q) => $q->where('is_active', 1));
                break;
            case 'inactive':
                $query->whereHas('account', fn($q) => $q->where('is_active', 0));
                break;
            default:
                break;
        }

        $jobs = $query->get();

        return view('exports.jobs', [
            'jobs' => $jobs
        ]);
    }
}
