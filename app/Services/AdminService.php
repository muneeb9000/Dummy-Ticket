<?php

namespace App\Services;

use App\Models\Admin;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class AdminService
{
    public function getAll()
    {
        return Admin::with('roles')
            ->whereDoesntHave('roles', function ($query) {
                $query->where('name', 'Super Admin');
            })
            ->latest()
            ->get();

    }

    public function store(array $data)
    {
        $data['password'] = Hash::make($data['password']);
        $admin = Admin::create($data);
        
        if (isset($data['role'])) {
            $role = Role::findById($data['role']);
            $admin->assignRole($role);
        }
        
        return $admin;
    }

    public function update(Admin $admin, array $data)
    {
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }
        
        $admin->update($data);
        
        if (isset($data['role'])) {
            $role = Role::findById($data['role']);
            $admin->syncRoles([$role]);
        }
        
        return $admin;
    }

    public function delete(Admin $admin)
    {
        return $admin->delete();
    }

    public function getById($id)
    {
        return Admin::with('roles')->findOrFail($id);
    }
}