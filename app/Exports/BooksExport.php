<?php

namespace App\Exports;

use App\Models\Book;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Events\AfterSheet;

class BooksExport implements FromQuery, WithHeadings, WithStyles, ShouldAutoSize, WithEvents, WithMapping
{
    protected $columns;

    public function __construct(array $columns)
    {
        $this->columns = $columns;
    }

    public function query()
    {
        return Book::select($this->columns);
    }

    public function headings(): array
    {
        // Add "No" as the first column
        return array_merge(['No'], $this->columns);
    }

    public function map($book): array
    {
        static $rowNumber = 0;
        $rowNumber++;

        // Map data and add row number as the first column
        $data = [];
        foreach ($this->columns as $column) {
            $data[] = $book->$column;
        }

        return array_merge([$rowNumber], $data);
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
