<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $adminUser = User::create([
            'name' => 'Admin ORYGAYA',
            'email' => 'admin@orygaya.com',
            'password' => Hash::make('Orygaya1999_'),
            'email_verified_at' => now(),
        ]);
        $adminUser->assignRole('admin');
    }

}
