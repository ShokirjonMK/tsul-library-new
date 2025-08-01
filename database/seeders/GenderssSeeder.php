<?php

namespace Database\Seeders;

use App\Models\ReferenceGender;
use Illuminate\Database\Seeder;

class GenderssSeeder extends Seeder
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
            'uz' => ['title' => "Erkak"],
            'en' => ['title' => "Male"],
        ];
        ReferenceGender::create($data);
        $data = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'uz' => ['title' => "Ayol"],
            'en' => ['title' => "Female"],
        ];
        ReferenceGender::create($data);
    }
}
