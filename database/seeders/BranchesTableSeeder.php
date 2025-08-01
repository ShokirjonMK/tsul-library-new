<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Department;
use Illuminate\Database\Seeder;

class BranchesTableSeeder extends Seeder
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
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'code' => "MK",
            'uz' => ['title' => "Markaziy bino"], 
            'en' => ['title' => "Central building"],
        ];
        $branch = Branch::create($data);
        
        $dData = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'organization_id'=>1,
            'branch_id'=>$branch->id,
            'uz' => ['title' => "Elektron katalog bo‘limi"],
            'en' => ['title' => "Electronic catalog department"],
        ];
        $department = Department::create($dData);

     
        
    }
}
