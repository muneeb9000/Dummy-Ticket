<?php

namespace App\Services;

use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Exception;

class RoleService
{

    public function create(array $data): Role
    {
        try {
            DB::beginTransaction();
            
            $role = Role::create([
                'name' => $data['name'],
                'guard_name' => 'admin'
            ]);
            
            DB::commit();
            
            return $role;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function update(Role $role, array $data): Role
    {
        try {
            DB::beginTransaction();
            
            $role->update([
                'name' => $data['name']
            ]);
            
            DB::commit();
            
            return $role->fresh();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function delete(Role $role): bool
    {
        try {
            DB::beginTransaction();
        
            $role->syncPermissions([]);
            $role->delete();
            
            DB::commit();
            
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }


    public function getAllWithPermissions()
    {
        return Role::with('permissions')->get();
    }

    public function assignPermissions(Role $role, array $permissions): Role
    {
        try {
            DB::beginTransaction();
            
            $role->syncPermissions($permissions);
            
            DB::commit();
            
            return $role->fresh('permissions');
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}