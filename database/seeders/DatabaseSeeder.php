<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
<<<<<<< HEAD
       $this->call(UsersTableSeeder::class);

=======
>>>>>>> bd045bba608f20d7eaa00d6941bf23dad4069364

        // $this->call(UsersTableSeeder::class);

        $this->call(PermissionTableSeeder::class);
    }
}
