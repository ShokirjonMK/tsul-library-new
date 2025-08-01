<?php

namespace Database\Seeders;

use App\Models\BookText;
use Illuminate\Database\Seeder;

class BookTextsSeeder extends Seeder
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
            'uz' => ['title' => "Lotin"],
            'en' => ['title' => "Latin"],
        ];
        BookText::create($data);
        $data = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'uz' => ['title' => "Kiril"],
            'en' => ['title' => "Cyrillic"],
        ];
        BookText::create($data);
        $data = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'uz' => ['title' => "Nemischa"],
            'en' => ['title' => "German"],
        ];
        BookText::create($data);
        $data = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'uz' => ['title' => "Fransuzcha"],
            'en' => ['title' => "French"],
        ];
        BookText::create($data);
        $data = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'uz' => ['title' => "Inglizcha"],
            'en' => ['title' => "English"],
        ];
        BookText::create($data);
        $data = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'uz' => ['title' => "Arab tili"],
            'en' => ['title' => "Arabic"],
        ];
        BookText::create($data);
    }
}
