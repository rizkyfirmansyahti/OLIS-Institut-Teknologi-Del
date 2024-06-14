<?php

namespace App\Imports;

use App\Models\CompactDisk;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMappedCells;

class CompactDisksImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new CompactDisk([
            'code'        => $row['code'] ?? null,
            'title'       => $row['title'] ?? null,
            'subject'     => $row['subject'] ?? null,
            'author'      => $row['author'] ?? null,
            'description' => $row['description'] ?? null,
            'source'      => $row['source'] ?? null,
            'cover'       => $row['cover'] ?? null,
            'major'       => $row['major'] ?? null,
            'category'    => $row['category'] ?? null,
            'year'        => $row['year'] ?? null,
            'status'      => $row['status'] ?? '',
        ]);
    }
}
