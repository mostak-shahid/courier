<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'System Admin',
            'email' => 'mostak.shahid@gmail.com',
            'username' => '01670058131',
            'password' => bcrypt('123456789'),
            'role' => 'admin',
            'active' => 1,
        ]);
        User::create([
            'name' => 'Dummy Merchant',
            'email' => 'dummy.merchant@email.com',
            'username' => '0147852369',
            'password' => bcrypt('123456789'),
            'role' => 'merchant',
            'active' => 1,
        ]);
        User::create([
            'name' => 'Dummy Merchant 2',
            'email' => 'dummy.merchant2@email.com',
            'username' => '987654321',
            'password' => bcrypt('123456789'),
            'role' => 'merchant',
            'active' => 0,
        ]);
        User::create([
            'name' => 'Dummy Driver',
            'email' => 'dummy.driver@email.com',
            'username' => '0123456789',
            'password' => bcrypt('123456789'),
            'role' => 'driver',
            'active' => 1,
        ]);
    }
}
