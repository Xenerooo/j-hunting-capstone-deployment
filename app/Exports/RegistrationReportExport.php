<?php

namespace App\Exports;

use App\Models\Accounts;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class RegistrationReportExport implements FromView
{
    protected $year, $userType;

    public function __construct($year, $userType)
    {
        $this->year = $year;
        $this->userType = $userType;
    }

    public function view(): View
    {
        $query = Accounts::query()
            ->whereYear('created_at', $this->year);

        if ($this->userType !== 'all') {
            $query->where('user_type', $this->userType);
        }

        $users = $query->get();

        return view('exports.registered-excel', [
            'users' => $users,
            'year' => $this->year,
            'type' => $this->userType
        ]);
    }
}
