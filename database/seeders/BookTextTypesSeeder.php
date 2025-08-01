<?php

namespace Database\Seeders;

use App\Models\BookTextType;
use Illuminate\Database\Seeder;

class BookTextTypesSeeder extends Seeder
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
            'uz' => ['title' => "Bosma shaklda"],
            'en' => ['title' => "In print"],
        ];
        BookTextType::create($data);
        $data = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'uz' => ['title' => "Brayl yozuvida"],
            'en' => ['title' => "In Braille"],
        ];
        BookTextType::create($data);
        $data = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'uz' => ['title' => "Audio shaklda"],
            'en' => ['title' => "In audio form"],
        ];
        BookTextType::create($data);
        $data = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'uz' => ['title' => "Nota"],
            'en' => ['title' => "note"],
        ];
        BookTextType::create($data);
    }
}
