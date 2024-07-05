<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionTableSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',

            'product-list',
            'product-create',
            'product-edit',
            'product-delete',

            'categories-list',
            'categories-create',
            'categories-edit',
            'categories-delete',

            'sub-categories-list',
            'sub-categories-create',
            'sub-categories-edit',
            'sub-categories-delete',

            'product-list-list',
            'product-list-create',
            'product-list-edit',
            'product-list-delete'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $superAdminRole = Role::create(['name' => 'super-admin']);

        // Lets give all permission to super-admin role.
        $allPermissionNames = Permission::pluck('name')->toArray();
        $superAdminRole->givePermissionTo($allPermissionNames);

        $superAdminUser = User::firstOrCreate([
            'email' => 'hima.redspark@gmail.com',
        ], [
            'name' => 'Super Admin',
            'email' => 'hima.redspark@gmail.com',
            'password' => Hash::make('12345678'),
        ]);

        $superAdminUser->assignRole($superAdminRole);
    }
}
