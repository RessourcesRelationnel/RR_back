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
        $user = User::create([
            'first_name' => 'nathan',
            'last_name' => 'GrosBG',
            'pseudo' => 'JESUISLEPLUSBOMOUAAA',
            'email' => 'nathan@gmail.com',
            'password' => Hash::make('nathan123'),
        ]);

        $user->assignRole('super-admin');
    }
}
