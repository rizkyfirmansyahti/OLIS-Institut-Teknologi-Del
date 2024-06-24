<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Book;
use App\Models\Lending;
use App\Models\LogVisitor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        // book with highest rating

        $bestBooks = Book::has('reviews')
            ->groupBy('slug')
            ->withCount('reviews')
            ->get()
            ->sortByDesc('rating')
            ->take(4);
        // dd($bestBooks);
        // return view('frontend.home.index', compact('bestBooks'));

        $pengunjungChartPerhari = $this->PrivatepengunjungChartPerhari();
        $pengunjungChartProdi = $this->PrivatepengunjungChartProdi();
        $peminjamanChartPerhari = $this->PrivatepeminjamanChartPerhari();
        // $peminjamanChartPerrole = $this->PrivatepeminjamanChartPerrole();
        $peminjamanChartPerprodi = $this->PrivatepeminjamanChartPerprodi();
        // dd($peminjamanChartPerrole);
        return view('frontend_revisi.home.index', compact('bestBooks', 'pengunjungChartPerhari', 'pengunjungChartProdi', 'peminjamanChartPerhari', 'peminjamanChartPerprodi'));
        // return view('layouts.frontend_revisi.master', compact('bestBooks'));
    }

    private function PrivatepengunjungChartPerhari()
    {
        $startDate = now()->subDays(7)->startOfDay();
        $visitors = LogVisitor::select('visited_at')
            ->where('visited_at', '>=', $startDate)
            ->get();

        $pengunjungPerHari = $visitors->groupBy(function ($date) {
            return Carbon::parse($date->visited_at)->isoFormat('dddd, D MMMM YYYY');
        });
        $visitorCounts = [];

        foreach ($pengunjungPerHari as $day => $visitors) {
            $visitorCounts[$day] = count($visitors);
        }

        $data = [
            'labels' => array_keys($visitorCounts),
            'datasets' => [
                [
                    'label' => 'Jumlah Pengunjung/Hari',
                    'data' => array_values($visitorCounts),
                    'backgroundColor' => 'rgba(54, 162, 235, 0.2)',
                    'borderColor' => 'rgba(54, 162, 235, 1)',
                    'borderWidth' => 1,
                ]
            ]
        ];

        return $data;
    }

    private function PrivatepengunjungChartProdi()
    {
        $startDate = now()->subMonths(12)->startOfMonth();
        $visitors = LogVisitor::select('visited_at', 'users.major')
            ->join('users', 'users.id', '=', 'log_visitors.user_id')
            ->where('visited_at', '>=', $startDate)
            ->get();

        $visitorCounts = [];
        foreach ($visitors as $visitor) {
            $bulan = Carbon::parse($visitor->visited_at)->translatedFormat('F');
            $major = $visitor->major;
            if (!isset($visitorCounts[$major][$bulan])) {
                $visitorCounts[$major][$bulan] = 0;
            }
            $visitorCounts[$major][$bulan]++;
        }

        // Determine unique months that have data
        $labels = collect($visitorCounts)->flatMap(function ($majorData) {
            return array_keys($majorData);
        })->unique()->sort()->values()->toArray();

        // Define colors for datasets
        $colors = [
            'rgba(54, 162, 235, 0.2)',  // Blue
            'rgba(255, 99, 132, 0.2)',  // Red
            'rgba(75, 192, 192, 0.2)',  // Green
            'rgba(153, 102, 255, 0.2)', // Purple
            'rgba(255, 159, 64, 0.2)',  // Orange
        ];

        $datasets = [];
        $colorIndex = 0;
        foreach ($visitorCounts as $major => $data) {
            $dataArr = [];
            foreach ($labels as $bulan) {
                $count = isset($data[$bulan]) ? $data[$bulan] : 0;
                $dataArr[] = $count;
            }

            $datasets[] = [
                'label' => $major,
                'data' => $dataArr,
                'backgroundColor' => $colors[$colorIndex % count($colors)],
                'borderColor' => rtrim($colors[$colorIndex % count($colors)], '0.2') . '1',
                'borderWidth' => 1,
            ];

            $colorIndex++;
        }

        $data = [
            'labels' => $labels,
            'datasets' => $datasets,
        ];

        return $data;
    }

    private function PrivatepeminjamanChartPerhari()
    {
        $startDate = now()->subDays(7)->startOfDay();
        $visitors = Lending::select('updated_at')
            ->where('updated_at', '>=', $startDate)
            ->where('status', 'lent')
            ->get();

        $pengunjungPerHari = $visitors->groupBy(function ($date) {
            return Carbon::parse($date->updated_at)->isoFormat('dddd, D MMMM YYYY');
        });
        $visitorCounts = [];

        foreach ($pengunjungPerHari as $day => $visitors) {
            $visitorCounts[$day] = count($visitors);
        }

        $data = [
            'labels' => array_keys($visitorCounts),
            'datasets' => [
                [
                    'label' => 'Jumlah Pengunjung/Hari',
                    'data' => array_values($visitorCounts),
                    'backgroundColor' => 'rgba(54, 162, 235, 0.2)',
                    'borderColor' => 'rgba(54, 162, 235, 1)',
                    'borderWidth' => 1,
                ]
            ]
        ];

        return $data;

    }

    private function PrivatepeminjamanChartPerprodi()
    {
        $startDate = now()->subMonths(12)->startOfMonth();
        $visitors = Lending::select('lendings.updated_at', 'users.major')
            ->join('users', 'users.id', '=', 'lendings.user_id')
            ->where('lendings.updated_at', '>=', $startDate)
            ->where('lendings.status', 'lent')
            ->get();

        $visitorCounts = [];
        foreach ($visitors as $visitor) {
            $bulan = Carbon::parse($visitor->visited_at)->translatedFormat('F');
            $major = $visitor->major;
            if (!isset($visitorCounts[$major][$bulan])) {
                $visitorCounts[$major][$bulan] = 0;
            }
            $visitorCounts[$major][$bulan]++;
        }

        $labels = collect($visitorCounts)->flatMap(function ($majorData) {
            return array_keys($majorData);
        })->unique()->sort()->values()->toArray();
        $colors = [
            'rgba(54, 162, 235, 0.2)',
            'rgba(255, 99, 132, 0.2)',
            'rgba(75, 192, 192, 0.2)',
            'rgba(153, 102, 255, 0.2)',
            'rgba(255, 159, 64, 0.2)',
        ];

        $datasets = [];
        $colorIndex = 0;
        foreach ($visitorCounts as $major => $data) {
            $dataArr = [];
            foreach ($labels as $bulan) {
                $count = isset($data[$bulan]) ? $data[$bulan] : 0;
                $dataArr[] = $count;
            }

            $datasets[] = [
                'label' => $major,
                'data' => $dataArr,
                'backgroundColor' => $colors[$colorIndex % count($colors)],
                'borderColor' => rtrim($colors[$colorIndex % count($colors)], '0.2') . '1',
                'borderWidth' => 1,
            ];

            $colorIndex++;
        }

        $data = [
            'labels' => $labels,
            'datasets' => $datasets,
        ];

        return $data;
    }












}
