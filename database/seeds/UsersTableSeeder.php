<?php

use App\User;
use App\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        DB::table('role_user')->truncate();


        $adminRole = Role::where('name', 'admin')->first();
        $moderatorRole = Role::where('name', 'moderator')->first();
        $userRole = Role::where('name', 'user')->first();

        $admin = User::create([

            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password')

        ]);

        $moderator = User::create([

            'name' => 'Moderator',
            'email' => 'moderator@moderator.com',
            'password' => Hash::make('password')

        ]);

        $user = User::create([

            'name' => 'User',
            'email' => 'user@user.com',
            'password' => Hash::make('password')

        ]);

        $admin->roles()->attach($adminRole);
        $moderator->roles()->attach($moderatorRole);
        $user->roles()->attach($userRole);
    }
}
