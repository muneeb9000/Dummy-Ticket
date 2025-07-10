<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoleRequest;
use App\Services\RoleService;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class RoleController extends Controller
{
    protected RoleService $service;

    public function __construct(RoleService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
         if (!Auth::user()->can('roles.view')) {
        abort(403, 'Unauthorized Access');
    }
        $roles = Role::select(['id', 'name', 'created_at', 'updated_at'])
        ->where('name', '!=', 'Super Admin')
        ->orderBy('name')
        ->get();


       if ($request->ajax()) {
        return response()->json([
            'success' => true,
            'data' => $roles
        ]);
         }
        return view('admin.pages.roles.index');
    }

    public function store(StoreRoleRequest $request)
    {
          if (!Auth::user()->can('roles.create')) {
        abort(403, 'Unauthorized Access');
    }
        try {
            $role = $this->service->create($request->validated());
            return response()->json([
                'success' => true,
                'message' => 'Role created successfully.',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
            ], 500);
        }
    }

    public function update(StoreRoleRequest $request, Role $role)
    {
          if (!Auth::user()->can('roles.edit')) {
        abort(403, 'Unauthorized Access');
    }
        try {
            $updated = $this->service->update($role, $request->validated());
            return response()->json([
                'success' => true,
                'message' => 'Role updated successfully.',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
            ], 500);
        }
    }

    public function destroy(Role $role)
    {
          if (!Auth::user()->can('roles.delete')) {
        abort(403, 'Unauthorized Access');
    }
        try {
            if ($role->users()->count() > 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cannot delete role. It is assigned to users.'
                ], 422);
            }
            $this->service->delete($role);
            return response()->json([
                'success' => true,
                'message' => 'Role deleted successfully.'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
            ], 500);
        }
    }

    public function getPermissions(Role $role)
    {
        $permissions = Permission::all();
        return view('admin.pages.roles.permission', compact('permissions','role'));
    }

    public function updatePermissions(Request $request)
    {
        $role = Role::findOrFail($request->role_id);
        $permissions = $request->permissions ?? [];
        $role->syncPermissions($permissions);

        return redirect()->back()->with('success', 'Permissions updated successfully');
    }
}
