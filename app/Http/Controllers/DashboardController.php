<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * @return array<string, mixed>
     */
    private function placeholderData(): array
    {
        return [
            'periodLabel' => now()->translatedFormat('F Y'),
            'kpis' => [
                [
                    'label' => __('Active employees'),
                    'value' => '—',
                    'hint' => __('Select a company to view headcount'),
                    'highlight' => true,
                ],
                [
                    'label' => __('Labor cost'),
                    'value' => '—',
                    'hint' => __('Current period gross total'),
                ],
                [
                    'label' => __('Total deductions'),
                    'value' => '—',
                    'hint' => __('IVSS, FAOV, INCES and others'),
                ],
                [
                    'label' => __('Processed payrolls'),
                    'value' => '0',
                    'hint' => __('Closed runs this period'),
                ],
            ],
            'recentPayrolls' => [],
        ];
    }

    public function __invoke(): View
    {
        return view('dashboard', $this->placeholderData());
    }
}
