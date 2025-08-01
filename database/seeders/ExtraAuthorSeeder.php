<?php

namespace Database\Seeders;

use App\Models\ExtraAuthor;
use Illuminate\Database\Seeder;

class ExtraAuthorSeeder extends Seeder
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
            'uz' => ['title' => 'Muharrir'],
        ];
        ExtraAuthor::create($data);
        $data = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'uz' => ['title' => "Taqrizchi"],
        ];
        ExtraAuthor::create($data);
        $data = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'uz' => ['title' => "Bosh muharrir"], 
        ];
        ExtraAuthor::create($data);
        $data = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'uz' => ['title' => "Tarjimon"],
        ];
        ExtraAuthor::create($data);
    }
}
