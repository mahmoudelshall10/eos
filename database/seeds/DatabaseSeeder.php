<?php

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
        $this->call(RolesTableSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(UserResearcherSeeder::class);
        $this->call(PermissionsTableSeeder::class);

    }
}
