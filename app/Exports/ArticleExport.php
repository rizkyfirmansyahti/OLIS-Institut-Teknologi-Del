<?php

namespace App\Exports;

use App\Models\Article;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ArticleExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize, WithEvents, WithMapping
{
    public function collection()
    {
        return Article::all();
    }

    public function map($article): array
    {
        static $rowNumber = 0;
        $rowNumber++;

        return [
            $rowNumber,
            $article->title,
            $article->slug,
            $article->body,
            $article->excerpt,
            $article->image,
            $article->user_id,
            $article->status,
            $article->views,
            $article->created_at,
            $article->updated_at,
        ];
    }

    public function headings(): array
    {
        return [
            'no',
            'title',
            'slug',
            'body',
            'excerpt',
            'image',
            'user_id',
            'status',
            'views',
            'created_at',
            'updated_at',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1 => ['font' => ['bold' => true]],
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $highestColumn = $sheet->getHighestColumn();
                $highestRow = $sheet->getHighestRow();

                // Apply styles to the headers
                $headerStyleArray = [
                    'font' => [
                        'bold' => true,
                        'color' => ['argb' => 'FF000000'],
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => ['argb' => 'FF00FF00'],
                    ],
                ];
                $sheet->getStyle('A1:' . $highestColumn . '1')->applyFromArray($headerStyleArray);

                // Auto size columns
                foreach (range('A', $highestColumn) as $column) {
                    $sheet->getColumnDimension($column)->setAutoSize(true);
                }
            },
        ];
    }
}
