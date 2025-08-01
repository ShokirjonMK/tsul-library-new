<?php

namespace Database\Seeders;

use App\Models\BookSubject;
use Illuminate\Database\Seeder;

class BookSubjectsSeeder extends Seeder
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
            'uz' => ['title' => "Amaliy fanlar"],
            'en' => ['title' => "Applied sciences"],
        ];
        BookSubject::create($data);
        $data = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'uz' => ['title' => "Aniq fanlar"],
            'en' => ['title' => "Exact Sciences"],
        ];
        BookSubject::create($data);
        $data = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'uz' => ['title' => "Tibbiyot"],
            'en' => ['title' => "Medicine"],
        ];
        BookSubject::create($data);
        $data = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'uz' => ['title' => "Tilshunoslik"],
            'en' => ['title' => "Linguistics"],
        ];
        BookSubject::create($data);
        $data = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'uz' => ['title' => "Adabiyot"],
            'en' => ['title' => "Literature"],
        ];
        BookSubject::create($data);
    }
}
