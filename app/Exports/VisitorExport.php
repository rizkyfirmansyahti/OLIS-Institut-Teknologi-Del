<?php

namespace App\Exports;

use App\Models\LogVisitor;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

class VisitorExport implements FromQuery
{
    use Exportable;
    protected $start_month;
    protected $end_month;
    protected $start_year;
    protected $end_year;

    public function __construct(int $start_month, int $end_month, int $start_year, int $end_year)
    {
        $this->start_month = $start_month;
        $this->end_month = $end_month;
        $this->start_year = $start_year;
        $this->end_year = $end_year;
    }

    public function query()
    {
        return LogVisitor::whereYear('visited_at', '>=', $this->start_year)
            ->whereYear('visited_at', '<=', $this->end_year)
            ->whereMonth('visited_at', '>=', $this->start_month)
            ->whereMonth('visited_at', '<=', $this->end_month);
    }
}
