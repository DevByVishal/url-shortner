<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]
            ->forgetCachedPermissions();

        $roles = [
            'SuperAdmin',
            'Admin',
            'Member',
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate([
                'name' => $role,
                'guard_name' => 'web'
            ]);
        }

        $permissions = [
            'company.view',
            'company.create',
            'company.edit',
            'company.delete',

            'user.view',
            'user.create',
            'user.edit',
            'user.delete',

            'invite.create',
            'invite.view',

            'short-url.create',
            'short-url.view',
            'short-url.delete',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web'
            ]);
        }
    }
}