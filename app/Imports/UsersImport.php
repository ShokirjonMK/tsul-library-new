<?php

namespace App\Imports;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class UsersImport implements ToCollection, WithChunkReading, ShouldQueue
{
    // /**
    // * @param array $row
    // *
    // * @return \Illuminate\Database\Eloquent\Model|null
    // */
    // public function model(array $row)
    // {
    //     dd($row);
    //     $oldUSer = User::where('login', '=', $row[0])->first();
    //     if ($oldUSer == null) {
    //         $data = [
    //             'login' => $row[0],
    //             'name' => $row[1],
    //             'email' => $row[0] . '@gmail.com',
    //             'password' => Hash::make($row[2]),
    //             'inventar_number' => 'f' . (User::count() + 1),
    //             'status' => 1,
    //         ];
    //         $user = User::create($data);
    //         $user->assignRole([5]);
    //         $gender_id = 0;
    //         if ($row[9] == "Erkak") {
    //             $gender_id = 1;
    //         } else {
    //             $gender_id = 2;
    //         }
    //         $userProfileData = [
    //             'phone_number' =>  $row[0],
    //             'pnf_code' =>  $row[3],
    //             'passport_seria_number' =>  $row[2],
    //             'date_of_birth' =>  $row[10],
    //             'kursi' =>  $row[11],
    //             'gender_id' =>  $gender_id,
    //             'organization_id' =>  1,
    //             'branch_id' =>  1,
    //             'department_id' =>  1,
    //             'user_id' =>  $user->id,
    //         ];
    //         return  UserProfile::create($userProfileData);
    //     }
    //     // return new User([
    //     //     'name'     => $row[0],
    //     //     'email'    => $row[1], 
    //     //     'password' => Hash::make($row[2]),
    //     //  ]);
    // }
    public function startRow(): int
    {
        return 1;
    }
    public function batchSize(): int
    {
        return 1000;
    }

    public function chunkSize(): int
    {
        return 500;
    }
    public function collection(Collection $rows)
    {

        foreach ($rows as $k=> $row) 
        {
            // if($k>=1500 && $k<1900){
            if($k>=1 ){
                $oldUSer=User::where('login', '=', $row[0])->first();
                

                // 'password' => Hash::make($row[2]),

                if($oldUSer==null){
                    $data=[
                        'login' => $row[0],
                        'name' => $row[1],
                        'email' => $row[0].'@gmail.com',
                        'password' => Hash::make('tashpmi2024'),
                        'inventar_number' => 'f'.(User::count()+1),
                        'status' => 1,
                    ]; 
                    $user= User::create($data);
                    $user->assignRole([5]);
                    
                    $gender_id=0;
                    if($row[9]=="Erkak"){
                        $gender_id=1;
                    }else{
                        $gender_id=2;
                    }
                    $userProfileData=[
                        'phone_number'=>  $row[0],
                        'pnf_code'=>  $row[3],
                        'passport_seria_number'=>  $row[2],
                        'date_of_birth'=>  $row[10],
                        'kursi'=>  $row[11],
                        'gender_id'=>  $gender_id,
                        'organization_id'=>  1,
                        'branch_id'=>  1,
                        'department_id'=>  1,
                        'user_id'=>  $user->id,
                    ];
                    UserProfile::create($userProfileData);

                }
            }
        }
    }
}
