<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;
class UserResearcherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $researcher = User::where([
            'name'     => 'researcher',
            'email'    => 'researcher@researcher.com',
        ])->first();

        if(!$researcher)
        {
            $researcher = User::create([
                'name'     => 'researcher',
                'email'    => 'researcher@researcher.com',
                'password' => bcrypt('12345678'),
                'role_id'  => 2,
            ]);
        }

        $researcher->assignRole('researcher');



        $user = User::where([
            'name'     => 'user',
            'email'    => 'user@user.com',
        ])->first();

        if(!$user)
        {
            $user = User::create([
                'name'     => 'user',
                'email'    => 'user@user.com',
                'password' => bcrypt('12345678'),
                'role_id'  => 3,
            ]);
        }
        $user->assignRole('user');
    }
}
