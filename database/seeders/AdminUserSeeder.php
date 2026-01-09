<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::where('email', 'wawa@gmail.com')->delete();

        User::create([
            'name' => 'Wawa',
            'email' => 'wawa@gmail.com',
            'password' => Hash::make('wawa1212'),
            'role' => 'admin',
        ]);
    }
}
