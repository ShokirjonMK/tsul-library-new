<?php

namespace Database\Seeders;

use App\Models\Where;
use Illuminate\Database\Seeder;

class WhereSeeder extends Seeder
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
            'uz' => ['title' => 'Xorij mamlakatlaridan'],
        ];
        Where::create($data);
        $data = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'uz' => ['title' => "MDH mamlakatlaridan"],
        ];
        Where::create($data);
    }
}
