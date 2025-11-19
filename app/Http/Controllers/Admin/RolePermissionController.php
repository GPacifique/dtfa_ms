<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolePermissionController extends Controller
{
    public function index()
    {
        $roles = Role::orderBy('name')->get();
        $permissions = Permission::orderBy('name')->get();
        return view('admin.roles.index', compact('roles', 'permissions'));
    }

    public function edit(Role $role)
    {
        $permissions = Permission::orderBy('name')->get();
        $rolePermissions = $role->permissions->pluck('name')->all();
        return view('admin.roles.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    public function update(Request $request, Role $role)
    {
        $data = $request->validate([
            'permissions' => ['nullable', 'array'],
            'permissions.*' => ['string'],
        ]);

        $role->syncPermissions($data['permissions'] ?? []);

        return redirect()->route('admin.roles.index')->with('status', 'Role permissions updated.');
    }

    public function storePermission(Request $request)
    {
        $data = $request->validate([
            'name' => ['required','string','max:255'],
        ]);

        Permission::firstOrCreate(['name' => $data['name'], 'guard_name' => 'web']);

        return redirect()->route('admin.roles.index')->with('status', 'Permission created.');
    }

    // Role creation
    public function create()
    {
        return view('admin.roles.create');
    }

    public function storeRole(Request $request)
    {
        $data = $request->validate([
            'name' => ['required','string','max:255','unique:roles,name'],
        ]);

        Role::create(['name' => $data['name'], 'guard_name' => 'web']);

        return redirect()->route('admin.roles.index')->with('status', 'Role created.');
    }

    // Rename / delete role
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('admin.roles.index')->with('status', 'Role deleted.');
    }

    // User to role assignment
    public function assignUserForm()
    {
        $users = User::orderBy('name')->get();
        $roles = Role::orderBy('name')->get();
        return view('admin.roles.assign', compact('users', 'roles'));
    }

    public function assignUserUpdate(Request $request)
    {
        $data = $request->validate([
            'user_id' => ['required','integer','exists:users,id'],
            'roles' => ['nullable','array'],
            'roles.*' => ['string'],
        ]);

        $user = User::findOrFail($data['user_id']);
        $user->syncRoles($data['roles'] ?? []);

        return redirect()->route('admin.roles.assignForm')->with('status', 'User roles updated.');
    }
}
