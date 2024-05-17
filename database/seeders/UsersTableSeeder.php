<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            //Admin
            [
                'name' => 'Admin',
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => hash::make('111'),
                'role' => 'admin',
                'status' => 'actif',
            ],
            // Syndic
            [
                'name' => 'Syndic',
                'username' => 'syndic',
                'email' => 'syndic@gmail.com',
                'password' => hash::make('111'),
                'role' => 'syndic',
                'status' => 'actif',
            ],

            // Copropriétaire
            [
                'name' => 'Coproprietaire',
                'username' => 'coproprietaire',
                'email' => 'coproprietaire@gmail.com',
                'password' => hash::make('111'),
                'role' => 'coproprietaire',
                'status' => 'inactif',
            ],





        ]);
    }
}
