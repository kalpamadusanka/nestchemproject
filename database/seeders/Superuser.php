<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class Superuser extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user =  User::create([
            'name' => 'SuperAdmin',
            'email' => 'nestchem@gmail.com',
            'password' => Hash::make('neo@123'),
            'role' => 'Superadmin',
            'status' => '1',

        ]);
    }
}
