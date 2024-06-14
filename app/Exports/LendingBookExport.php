<?php

namespace App\Exports;

use App\Models\Lending;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

class LendingBookExport implements FromQuery
{
    use Exportable;
    protected $start_month;
    protected $end_month;
    protected $status;
    protected $type;
    public function __construct($start_month,  $end_month, string $status, string $type)
    {
        $this->start_month = $start_month;
        $this->end_month = $end_month;
        $this->status = $status;
        $this->type = $type;
    }

    public function query()
    {
        // dateFormat: "m/Y",
        if ($this->type == 'book') {
            return Lending::with('user', 'book')
                ->where('status', $this->status)
                ->whereBetween('lending_date', [$this->start_month, $this->end_month]);
        } else {
            return Lending::with('user', 'compactDisk')
                ->where('status', $this->status)
                ->whereBetween('lending_date', [$this->start_month, $this->end_month]);
        }
    }
}
