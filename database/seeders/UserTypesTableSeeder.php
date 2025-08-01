<?php

namespace Database\Seeders;

use App\Models\UserType;
use Illuminate\Database\Seeder;

class UserTypesTableSeeder extends Seeder
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
            'uz' => ['title' => 'Bakalavr'], 
            'en' => ['title' => 'Bachelor'],
        ];
        UserType::create($data); 
        $data = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'uz' => ['title' => 'Magistr'], 
            'en' => ['title' => 'Masters'],
        ];
        UserType::create($data); 

        $data2 = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'uz' => ['title' => 'Professor-o‘qituvchi'], 
            'en' => ['title' => 'Teachers & Professors'],
        ];
        UserType::create($data2); 
        

        $data = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'uz' => ['title' => "No ma'lum"], 
            'en' => ['title' => 'Un known'],
        ];
        UserType::create($data); 
        $data3 = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'uz' => ['title' => "ARM xodimi"], 
            'en' => ['title' => 'IRS employee'],
        ];
        UserType::create($data3);

        $data = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'uz' => ['title' => 'Sirtqi'], 
            'en' => ['title' => 'Sirtqi'],
        ];
        UserType::create($data); 
        $data = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'uz' => ['title' => "Qo‘shma ta'lim"], 
            'en' => ['title' => "Qo‘shma ta'lim"],
        ];
        UserType::create($data);

        $data = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'uz' => ['title' => 'Doktorant'], 
            'en' => ['title' => 'Doktorant'],
        ];
        UserType::create($data); 
       
        $data3 = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'uz' => ['title' => "Labarant"], 
            'en' => ['title' => 'Labarant'],
        ];
        UserType::create($data3);
       
        $data3 = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'uz' => ['title' => "Bakalavr"], 
            'en' => ['title' => 'Bakalavr'],
        ];
        UserType::create($data3);
        $data3 = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'uz' => ['title' => "Boshqalar"], 
            'en' => ['title' => 'Others'],
        ];
        UserType::create($data3);
        
      
        $data3 = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'uz' => ['title' => "Dekan"], 
            'en' => ['title' => 'Dean'],
        ];
        UserType::create($data3);
        $data3 = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'uz' => ['title' => "Prorektor"], 
            'en' => ['title' => 'Prorektor'],
        ];
        UserType::create($data3);
        $data3 = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'uz' => ['title' => "Bo‘lim boshlig‘i"], 
            'en' => ['title' => "Bo‘lim boshlig‘i"],
        ];
        UserType::create($data3);
        $data3 = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'uz' => ['title' => "Dekan o‘rinbosari"], 
            'en' => ['title' => "Dekan o‘rinbosari"],
        ];
        UserType::create($data3);
        $data3 = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'uz' => ['title' => "Kafedra mudiri"], 
            'en' => ['title' => "Kafedra mudiri"],
        ];
        UserType::create($data3);

        $data3 = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'uz' => ['title' => "Ishchi xodim"], 
            'en' => ['title' => "Ishchi xodim"],
        ];
        UserType::create($data3);

        $data3 = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'uz' => ['title' => "Talaba magistir"], 
            'en' => ['title' => "Talaba magistir"],
        ];
        UserType::create($data3);
        $data3 = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'uz' => ['title' => "ARM bo‘lim mudiri"], 
            'en' => ['title' => "ARM bo‘lim mudiri"],
        ];
        UserType::create($data3);
        $data3 = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'uz' => ['title' => "Farrosh"], 
            'en' => ['title' => "Farrosh"],
        ];
        UserType::create($data3);
        
    }
}
