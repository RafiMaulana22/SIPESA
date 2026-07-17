<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@sipesa.id'],
            [
                'name' => 'Admin Desa',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'status' => true,
                'email_verified_at' => now(),
            ],
        );

        User::updateOrCreate(
            ['email' => 'kades@sipesa.id'],
            [
                'name' => 'Kepala Desa',
                'password' => Hash::make('password'),
                'role' => 'kepala_desa',
                'status' => true,
                'email_verified_at' => now(),
            ],
        );
    }
}
