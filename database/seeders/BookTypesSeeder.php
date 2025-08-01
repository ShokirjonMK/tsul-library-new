<?php

namespace Database\Seeders;

use App\Models\BooksType;
use Illuminate\Database\Seeder;

class BookTypesSeeder extends Seeder
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
            'uz' => ['title' => 'Darslik'],
            'en' => ['title' => 'Textbook'],
        ];
        BooksType::create($data);
        $data = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'uz' => ['title' => "O‘quv qo‘llanma"],
            'en' => ['title' => 'Study guide'],
        ];
        BooksType::create($data);
        $data = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'uz' => ['title' => "Siyosiy adabiyot"],
            'en' => ['title' => 'Political books'],
        ];
        BooksType::create($data);
        $data = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'uz' => ['title' => "Ilmiy kitoblar"],
            'en' => ['title' => "Ilmiy kitoblar"],
        ];
        BooksType::create($data);
        $data = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'uz' => ['title' => "Monografiya"],
            'en' => ['title' => "Monografiya"],
        ];
        BooksType::create($data);
        $data = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'uz' => ['title' => "To‘plamlar"],
            'en' => ['title' => "To‘plamlar"],
        ];
        BooksType::create($data);
        $data = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'uz' => ['title' => "Badiiy kitoblar"],
            'en' => ['title' => "Badiiy kitoblar"],
        ];
        BooksType::create($data);
        $data = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'uz' => ['title' => "Lug‘at"],
            'en' => ['title' => "Dictionary"],
        ];
        BooksType::create($data);
        $data = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'uz' => ['title' => "Ma'lumotnoma"],
            'en' => ['title' => "Ma'lumotnoma"],
        ];
        BooksType::create($data);
        $data = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'uz' => ['title' => "Broshura"],
            'en' => ['title' => "Broshura"],
        ];
        BooksType::create($data);
        $data = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'uz' => ['title' => "Metodik qo‘llanma"],
            'en' => ['title' => "Metodik qo‘llanma"],
        ];
        BooksType::create($data);
        
        $data = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'uz' => ['title' => "Dissertatsiya"],
            'en' => ['title' => "Dissertatsiya"],
        ];
        BooksType::create($data);
        $data = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'uz' => ['title' => "Nomzodlik dissertatsiyasi"],
            'en' => ['title' => "Nomzodlik dissertatsiyasi"],
        ];
        BooksType::create($data);
        $data = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'uz' => ['title' => "Gazeta"],
            'en' => ['title' => "Gazeta"],
        ];
        BooksType::create($data);
        $data = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'uz' => ['title' => "Jurnal"],
            'en' => ['title' => "Journal"],
        ];
        BooksType::create($data);
        $data = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'uz' => ['title' => "Qoidalar"],
            'en' => ['title' => "Qoidalar"],
        ];
        BooksType::create($data);
        $data = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'uz' => ['title' => "Va boshqa"],
            'en' => ['title' => "Va boshqa"],
        ];
        BooksType::create($data);
        $data = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'uz' => ['title' => "Mirziyoyev asarlari"],
            'en' => ['title' => "Mirziyoyev asarlari"],
        ];
        BooksType::create($data);
        $data = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'uz' => ['title' => "To‘plam"],
            'en' => ['title' => "To‘plam"],
        ];
        BooksType::create($data);
        $data = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'uz' => ['title' => "Kitob-albom"],
            'en' => ['title' => "Kitob-albom"],
        ];
        BooksType::create($data);
    }
}
