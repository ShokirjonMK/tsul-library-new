<?php

namespace Database\Seeders;

use App\Models\BookAccessType;
use Illuminate\Database\Seeder;

class BookAccessTypesSeeder extends Seeder
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
            'code' => "ochiq",
            'created_by' => 1,
            'updated_by' => 1,
            'uz' => ['title' => "OCHIQ KIRISH"],
            'en' => ['title' => "OPEN ACCESS"],
        ];
        BookAccessType::create($data);
        $data = [
            'isActive' => 1,
            'code' => "yopiq",
            'created_by' => 1,
            'updated_by' => 1,
            'uz' => ['title' => "YOPIQ KIRISH"],
            'en' => ['title' => "CLOSED ACCESS"],
        ];
        BookAccessType::create($data);
    }
}
