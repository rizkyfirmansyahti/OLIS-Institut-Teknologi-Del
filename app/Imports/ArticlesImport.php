<?php

namespace App\Imports;

use App\Models\Article;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ArticlesImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Article([
            'title' => $row['title'],
            'slug' => $row['slug'],
            'body' => $row['body'],
            'excerpt' => $row['excerpt'],
            'image' => $row['image'],
            'user_id' => $row['user_id'],
            'status' => $row['status'],
            'views' => $row['views'],
        ]);
    }

    public function headingRow(): int
    {
        return 2;
    }
}
