<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(PermissionSeeder::class);
        $adminEmail = 'admin@gmail.com';
        $password = '12345678';
        $roleName = 'Super Admin';
        $role = Role::where('name', $roleName)->first();
        $admin = Admin::where('email', $adminEmail)->first();
        if (!$admin) {
            $admin = Admin::create([
                'name' => 'Admin',
                'email' => $adminEmail,
                'password' => Hash::make($password),
            ]);
        }
        if (!$admin->hasRole($roleName)) {
            $admin->assignRole($roleName);
        }
    }
}
