<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'David Villa',
            'email' => 'dvilladuran@gmail.com',
            'password' => bcrypt('deemde10'),
        ])->assignRole('Administrador');
        User::factory(9)->create();
    }
}
