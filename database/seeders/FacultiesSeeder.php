<?php

namespace Database\Seeders;

use App\Models\Faculty;
use Illuminate\Database\Seeder;

class FacultiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'organization_id' => 1,
            'branch_id' => 1,
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'code' => "MK",
            'uz' => ['title' => "Fakultet 1"], 
            'en' => ['title' => "Faculty 1"],
        ];
        Faculty::create($data);
    }
}
