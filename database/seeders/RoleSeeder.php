<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()['cache']->forget('spatie.permission.cache');

        Role::create([
            'name'  => config('permission.super_admin_name'),
            'level' => Role::SUPER_ADMIN_LEVEL
        ]);

        $adminRole = Role::create([
            'name'  => 'Administrador',
            'level' => Role::ADMINISTRADOR_LEVEL
        ]);

        $adminRole->givePermissionTo(
            Permission::withoutGlobalScopes()->where('level', '>=', $adminRole->level)->get()
        );
    }
}
