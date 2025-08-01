<?php

namespace Database\Seeders;

use App\Models\BookFileType;
use Illuminate\Database\Seeder;

class BookFileTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'uz' => ['title' => "Matn"],
            'en' => ['title' => "Text"],
        ];
        BookFileType::create($data);
        $data = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'uz' => ['title' => "Ovoz"],
            'en' => ['title' => "Sound"],
        ];
        BookFileType::create($data);
        $data = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'uz' => ['title' => "Video"],
            'en' => ['title' => "Video"],
        ];
        BookFileType::create($data);
    }
}
