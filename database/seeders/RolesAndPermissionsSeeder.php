<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Permissions
        $perms = [
            'manage users',
            'manage sessions',
            'manage students',
            'manage finances',
            'view reports',
        ];

        foreach ($perms as $p) {
            Permission::firstOrCreate(['name' => $p]);
        }

        // Roles
        $roles = [
            'super-admin' => $perms,
            'admin' => ['manage users','manage sessions','manage students','manage finances','view reports'],
            'coach' => ['manage sessions','manage students','view reports'],
            'staff' => ['manage students','view reports'],
            'parent' => [],
        ];

        foreach ($roles as $roleName => $rolePerms) {
            $role = Role::firstOrCreate(['name' => $roleName]);
            if (!empty($rolePerms)) {
                $role->syncPermissions($rolePerms);
            }
        }

        // Attach super-admin role to first user (if exists) or any user with email admin@local
        $user = User::where('email', 'admin@local')->orWhere('id', 1)->first();
        if ($user) {
            $user->assignRole('super-admin');
        }
    }
}
