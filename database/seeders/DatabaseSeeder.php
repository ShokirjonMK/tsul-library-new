<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            OrganizationSeeder::class,
            BranchesTableSeeder::class,

            PermissionTableSeeder::class,
            UserTypesTableSeeder::class,
            BookTypesSeeder::class,
            BookLanguagesSeeder::class,
            BookTextsSeeder::class,
            BookTextTypesSeeder::class,
            BookAccessTypesSeeder::class,
            BookFileTypesSeeder::class,
            BookSubjectsSeeder::class,
            GenderssSeeder::class,

            FacultiesSeeder::class,
            CreateAdminUserSeeder::class,
            ExtraAuthorSeeder::class,
            WhoSeeder::class,
            WhereSeeder::class,


        ]);
    }
}
