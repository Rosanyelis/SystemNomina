<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class ReportController extends Controller
{
    public function payrollSummary(): View
    {
        return view('reports.payroll-summary', [
            'periodLabel' => now()->translatedFormat('F Y'),
            'companyName' => null,
            'rows' => [],
            'totals' => [
                'gross' => '—',
                'deductions' => '—',
                'net' => '—',
            ],
        ]);
    }
}
