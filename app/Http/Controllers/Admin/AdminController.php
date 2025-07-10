<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use Spatie\Permission\Models\Role;
use App\Models\Admin;
use App\Services\AdminService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Exception;

class AdminController extends Controller
{
    protected $service;

    public function __construct(AdminService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {

         if (!Auth::user()->can('admin.view')) {
        abort(403, 'Unauthorized Access');
    }
        try {
            $admins = $this->service->getAll();
            $roles = Role::where('name', '!=', 'Super Admin')->get();
            
            if ($request->ajax()) {
                 return response()->json([
                    'draw' => $request->input('draw', 1),
                    'recordsTotal' => Admin::count(),
                    'recordsFiltered' => Admin::count(),
                    'data' => $admins,
                    'roles' => $roles
            ]);
            }

            return view('admin.pages.admins.index', compact('roles'));
        } catch (Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to load admins'
                ], 500);
            }
            abort(500, 'Failed to load admins');
        }
    }

    public function store(StoreAdminRequest $request)
    {
          if (!Auth::user()->can('admin.create')) {
        abort(403, 'Unauthorized Access');
    }
        try {
            $admin = $this->service->store($request->validated());
            return response()->json([
                'success' => true,
                'message' => 'Admin created successfully',
                'data' => $admin
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create admin'
            ], 500);
        }
    }

    public function show($id, Request $request)
    {
        try {
            $admin = $this->service->getById($id);
            return response()->json([
                'success' => true,
                'data' => $admin
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Admin not found'
            ], 404);
        }
    }

    public function update(UpdateAdminRequest $request, $id)
    {
          if (!Auth::user()->can('admin.edit')) {
        abort(403, 'Unauthorized Access');
    }
        
        try {
            $admin = $this->service->getById($id);
            $updatedAdmin = $this->service->update($admin, $request->validated());
            return response()->json([
                'success' => true,
                'message' => 'Admin updated successfully',
                'data' => $updatedAdmin
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update admin'
            ], 500);
        }
    }

    public function destroy($id, Request $request)
    {
          if (!Auth::user()->can('admin.delete')) {
        abort(403, 'Unauthorized Access');
    }
        try {
            $admin = $this->service->getById($id);
            $this->service->delete($admin);
            return response()->json([
                'success' => true,
                'message' => 'Admin deleted successfully'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete admin'
            ], 500);
        }
    }

     public function profile(Request $request)
    {
        $user = Auth::user();
        return view('admin.pages.admins.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8|confirmed',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);
        if ($request->hasFile('photo')) {
            if ($user->image) {
                $oldImagePath = public_path('profile_images/' . basename($user->image));
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
        
            $image = $request->file('photo');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('profile_images'), $imageName);
        
            $user->image = 'profile_images/' . $imageName;
        }
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
}