<?php

namespace Database\Seeders;

use App\Models\BookLanguage;
use Illuminate\Database\Seeder;

class BookLanguagesSeeder extends Seeder
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
            'uz' => ['title' => "O‘zbekcha"],
            'en' => ['title' => "Uzbek"],
        ];
        BookLanguage::create($data);
        $data = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'uz' => ['title' => "Ruscha"],
            'en' => ['title' => "Russian"],
        ];
        BookLanguage::create($data);
        $data = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'uz' => ['title' => "Inglizcha"],
            'en' => ['title' => "English"],
        ];
        BookLanguage::create($data);
        $data = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'uz' => ['title' => "Nemischa"],
            'en' => ['title' => "German"],
        ];
        BookLanguage::create($data);
        
        $data = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'uz' => ['title' => "O‘zbekcha&Ruscha&Inglizcha"],
            'en' => ['title' => "O‘zbekcha&Ruscha&Inglizcha"],
        ];
        BookLanguage::create($data);
        
        $data = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'uz' => ['title' => "O‘zbekcha&Ruscha"],
            'en' => ['title' => "O‘zbekcha&Ruscha"],
        ];
        BookLanguage::create($data);
        
        $data = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'uz' => ['title' => "O‘zbekcha&Inglizcha"],
            'en' => ['title' => "O‘zbekcha&Inglizcha"],
        ];
        BookLanguage::create($data);
        
        $data = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'uz' => ['title' => "O‘zbekcha&Nemischa"],
            'en' => ['title' => "O‘zbekcha&Nemischa"],
        ];
        BookLanguage::create($data);
         
        
        $data = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'uz' => ['title' => "Fransuzcha"],
            'en' => ['title' => "French"],
        ];
        BookLanguage::create($data);
        $data = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'uz' => ['title' => "Qozoqcha"],
            'en' => ['title' => "Kazak"],
        ];
        BookLanguage::create($data);
        $data = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'uz' => ['title' => "Qoraqalpoq"],
            'en' => ['title' => "Qoraqalpoq"],
        ];
        BookLanguage::create($data);
        $data = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'uz' => ['title' => "Arab tili"],
            'en' => ['title' => "Arab tili"],
        ];
        BookLanguage::create($data);
    }
}
