<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserProfile;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user = User::create([
            'name' => 'Karimov Elyor',
            'inventar_number' => 'f1',
            'email' => 'karimovelyor@gmail.com',
            'login' => 'karimovelyor@gmail.com',
            'password' => bcrypt('$$19Alom')
        ]);
        
        $userProfileData=[
            'phone_number'=>  "99893249889",
            'organization_id'=>  1,
            'branch_id'=>  1,
            'user_id'=>  $user->id,
        ];
        UserProfile::create($userProfileData);
        
        $role = Role::create(['name' => 'SuperAdmin']);
        
        $permissions = Permission::pluck('id','id')->all();
   
        $role->syncPermissions($permissions);
     
        $user->assignRole([$role->id]);
        
        $role = Role::create(['name' => 'Admin']);
        $role = Role::create(['name' => 'Manager']);
        $role = Role::create(['name' => 'Accountant']);
        $role = Role::create(['name' => 'Reader']);
        $role = Role::create(['name' => 'Author']);
        $role = Role::create(['name' => 'User']);
 

    }
}
