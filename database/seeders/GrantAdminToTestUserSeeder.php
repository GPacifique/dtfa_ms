<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class GrantAdminToTestUserSeeder extends Seeder
{
    public function run(): void
    {
        // Forget cached permissions
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        // Find a user to grant admin role to. Prefer user with email 'admin@example.com', else first user.
        $user = User::where('email', 'admin@example.com')->first();
        if (! $user) {
            $user = User::first();
        }

        if (! $user) {
            $this->command->info('No users found in database. Create a user first.');
            return;
        }

        // Ensure role exists
        $role = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);

        $user->assignRole($role->name);

        $this->command->info('Assigned role "admin" to user: ' . $user->email);
    }
}
