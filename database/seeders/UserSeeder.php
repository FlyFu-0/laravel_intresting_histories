<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        for ($i = 1; $i <= 4; $i++) {
            $username = "User$i";

            $user = new User;
            $user->name = $username;
            $user->email = strtolower($username) . '@mail.com';
            $user->password = Hash::make(strtolower($username));
            $user->save();

            $user->role()->attach(Role::all()->where('name', 'user')->first()->id);
            $user->save();
        }
    }
}
