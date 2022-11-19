<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'username' => 'admin',
            'name' => 'Administrator',
            'signature_path' => 'signature/signature1.jpg',
            'password' => bcrypt('password'),
            'api_token' => Hash::make(Str::random(40)),
        ]);
        $user->assignRole('admin');

        return $user;
    }
}