<?php

// app/Imports/BooksImport.php
namespace App\Imports;

use App\Models\Book;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BooksImport implements ToModel, WithHeadingRow
{

    public function model(array $row)
    {
        return new Book([
            'code'          => $row['code'] ?? null,
            'title'         => $row['title'] ?? null,
            'slug'          => $row['slug'] ?? null,
            'author'        => $row['author'] ?? null,
            'isbn'          => $row['isbn'] ?? null,
            'cover'         => $row['cover'] ?? null,
            'description'   => $row['description'] ?? null,
            'publisher'     => $row['publisher'] ?? null,
            'language'      => $row['language'] ?? null,
            'edition'       => $row['edition'] ?? null,
            'subject'       => $row['subject'] ?? null,
            'classification' => $row['classification'] ?? null,
            'cp_or'         => $row['cp_or'] ?? null,
            'year'          => $row['year'] ?? null,
            'location'      => $row['location'] ?? null,
            'status'        => $row['status'] ?? 1,
        ]);
    }
}
