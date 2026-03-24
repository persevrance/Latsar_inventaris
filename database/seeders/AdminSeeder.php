<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'nama' => 'Admin UPA-TIK',
            'email' => 'upa-tik@pnb.ac.id',
            'password' => Hash::make('password123'),
            'role' => 'admin'
        ]);
    }
}
