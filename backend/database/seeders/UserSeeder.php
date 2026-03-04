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

        $admin = User::withTrashed()->updateOrCreate(
            ['email' => 'admin@example.com'],
            ['name' => 'Admin',
            'password' => Hash::make('password'),]
        );
        if($admin->trashed()){
            $admin->restore();
        }
        $admin->assignRole('admin');

        $customer = User::withTrashed()->updateOrCreate(
            ['email' => 'customer@example.com'],
            ['name' => 'customer',
            'password' => Hash::make('password'),]
        );
        if($customer->trashed()){
            $customer->restore();
        }
        $customer->assignRole('customer');
    }
}
