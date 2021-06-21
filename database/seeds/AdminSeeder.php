<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::where([
            'name'     => 'admin',
            'email'    => 'admin@admin.com',
        ])->first();

        if(!$admin)
        {
            $admin = User::create([
                'name'     => 'admin',
                'email'    => 'admin@admin.com',
                'password' => bcrypt('12345678'),
                'role_id'  => 1,
            ]);
        }

        $admin->assignRole('admin');

    }
}
