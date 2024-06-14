<?php

namespace App\Http\Controllers\Backend;

use App\Models\Lending;
use App\Models\LogVisitor;
use Illuminate\Http\Request;
use App\Exports\VisitorExport;
use App\Exports\LendingBookExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function index()
    {
        return view('backend.reports.index');
    }

    public function exportLendingBook(Request $request, $status)
    {
        $start_month = $request->start_month;
        $end_month = $request->end_month;

        return Excel::download(new LendingBookExport($start_month, $end_month, $status, 'book'), 'LendingBook.xlsx');
    }

    public function exportLendingCD(Request $request, $status)
    {
        $start_month = $request->start_month;
        $end_month = $request->end_month;

        return Excel::download(new LendingBookExport($start_month, $end_month, $status, 'cd_dvd'), 'LendingCD.xlsx');
    }

    public function exportVisitor(Request $request)
    {
        $start_month = $request->start_month;
        $end_month = $request->end_month;
        $start_year = $request->start_year;
        $end_year = $request->end_year;

        return Excel::download(new VisitorExport($start_month, $end_month, $start_year, $end_year), 'Visitor.xlsx');
    }

    public function viewLendingBook(Request $request, $status)
    {
        $start_month = $request->start_month;
        $end_month = $request->end_month;
        $start_year = $request->start_year;
        $end_year = $request->end_year;

        $lendings = Lending::with('user', 'book')
            ->where('status', $status)
            ->whereYear('lending_date', '>=', $start_year)
            ->whereYear('lending_date', '<=', $end_year)
            ->whereMonth('lending_date', '>=', $start_month)
            ->whereMonth('lending_date', '<=', $end_month)
            ->get();

        return view('backend.reports.lending-book', compact('lendings', 'start_month', 'end_month', 'start_year', 'end_year'));
    }

    public function viewLendingCD(Request $request, $status)
    {
        $start_month = $request->start_month;
        $end_month = $request->end_month;
        $start_year = $request->start_year;
        $end_year = $request->end_year;

        $lendings = Lending::with('user', 'compactDisk')
            ->where('status', $status)
            ->whereYear('lending_date', '>=', $start_year)
            ->whereYear('lending_date', '<=', $end_year)
            ->whereMonth('lending_date', '>=', $start_month)
            ->whereMonth('lending_date', '<=', $end_month)
            ->get();

        return view('backend.reports.lending-cd-dvd', compact('lendings', 'start_month', 'end_month', 'start_year', 'end_year'));
    }

    public function viewVisitor(Request $request)
    {
        $start_month = $request->start_month;
        $end_month = $request->end_month;
        $start_year = $request->start_year;
        $end_year = $request->end_year;

        $visitors = LogVisitor::with('user')
            ->whereYear('visited_at', '>=', $start_year)
            ->whereYear('visited_at', '<=', $end_year)
            ->whereMonth('visited_at', '>=', $start_month)
            ->whereMonth('visited_at', '<=', $end_month)
            ->get();

        return view('backend.reports.visitor', compact('visitors', 'start_month', 'end_month', 'start_year', 'end_year'));
    }
}
