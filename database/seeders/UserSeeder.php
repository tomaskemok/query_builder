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
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name'     => config('permission.super_admin_name'),
            'email'    => config('permission.super_admin_email'),
            'password' => Hash::make(config('permission.super_admin_password')),
        ])->assignRole(config('permission.super_admin_name'));

        if (!app()->environment('production')) {
            User::factory()->create([
                'name'     => 'Admin ' . config('permission.super_admin_name'),
                'email'    => 'admin.' . config('permission.super_admin_email'),
                'password' => Hash::make(config('permission.super_admin_password')),
            ])->assignRole('Administrador');
        }
    }
}
