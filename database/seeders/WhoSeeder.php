<?php

namespace Database\Seeders;

use App\Models\Who;
use Illuminate\Database\Seeder;

class WhoSeeder extends Seeder
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
            'uz' => ['title' => 'Bakalavrlarga'],
        ];
        Who::create($data);
        $data = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'uz' => ['title' => "Magistrlarga"],
        ];
        Who::create($data);
    }
}
