<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $modules = [
            'faqs-categories',
            'faqs',
            'blog-categories',
            'blogs',
            'reviews',
            'coupons',
            'media',
            'visa-flags',
            'bookings',
            'roles',
            'admin',
            'inquiries',
            'settings',
            'snippets',
            'seo',
            'redirector',
        ];

        $actions = ['create', 'view', 'edit', 'delete'];

        $permissionNames = [];

        foreach ($modules as $module) {
            foreach ($actions as $action) {
                $permissionName = "{$module}.{$action}";
                Permission::firstOrCreate(['name' => $permissionName]);
                $permissionNames[] = $permissionName;
            }
        }

        $singlePermissions = [
            'dashboard.view',
            'bookings.approval',
            'custom-payment.view',
            'flight-reservation.view',
            'hotel-booking.view',
            'insurance.view',
            'guide.view',
            'flight-hotel.view',
            'total-blogs.view',
            'total-faqs.view',
            'total-reviews.view',
            'total-users.view'
        ];

        foreach ($singlePermissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
            $permissionNames[] = $permission;
        }

        $roleName = 'Super Admin';
        $role = Role::firstOrCreate(['name' => $roleName]);

        $role->syncPermissions($permissionNames);
    }
}
