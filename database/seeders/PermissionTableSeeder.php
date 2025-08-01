<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'list',
            'create',
            'edit',
            'delete',
            'deletedb',

            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'user-deletedb',

            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'role-deletedb',

            'permission-list',
            'permission-create',
            'permission-edit',
            'permission-delete',
            'permission-deletedb',

            'post-list',
            'post-create',
            'post-edit',
            'post-delete',
            'post-deletedb',

        ];

        foreach ($data as $permission) {
            Permission::create(['name' => $permission]);
        }

         
    }
}
