<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Role;

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
        // $authorRole = Role::where('name', 'author')->first();
        $userRole = Role::where('name', 'user')->first();

        $admin = User::create([
        	'name' => 'Admin User',
        	'email' => 'admin@admin.com',
        	'password' => Hash::make('adminadmin'),
            'status' => 'active',
            'email_verified_at' => '2020-04-19 22:30:36',
        ]);
        // $author = User::create([
        // 	'name' => 'Author User',
        // 	'email' => 'author@author.com',
        // 	'password' => Hash::make('authorauthor')

        // ]);
        $user = User::create([
        	'name' => 'User User',
        	'email' => 'user@user.com',
        	'password' => Hash::make('useruser'),
            'status' => 'active',
            'email_verified_at' => '2020-04-19 22:30:36',

        ]);

        $admin->roles()->attach($adminRole);
        // $author->roles()->attach($authorRole);
        $user->roles()->attach($userRole);
    }
}
