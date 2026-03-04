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
        $admin = User::firstOrCreate([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
        ]);
        $admin->assignRole('admin');

        $customer = User::firstOrCreate([
            'name' => 'Customer',
            'email' => 'customer@example.com',
            'password' => Hash::make('password'),
        ]);
        $customer->assignRole('customer');
    }
}
