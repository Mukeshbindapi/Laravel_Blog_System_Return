<?php

namespace Database\Seeders;

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
        User::create([
            'name' => 'Mukesh kumar',
            'email' => 'mukeshvindra@gmail.com',
            'password' => Hash::make(23130200),
            'is_admin' => 1
        ]);
    }
}
