<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::firstOrCreate(['name' => 'view dashboard']);
        Permission::firstOrCreate(['name' => 'manage users']);
        Permission::firstOrCreate(['name' => 'manage products']);
        Permission::firstOrCreate(['name' => 'manage settings']);

        // create roles and assign created permissions
        $roleViewer = Role::firstOrCreate(['name' => 'viewer']);
        $roleViewer->syncPermissions(['view dashboard']);

        $roleEditor = Role::firstOrCreate(['name' => 'editor']);
        $roleEditor->syncPermissions(['view dashboard', 'manage products']);

        $roleAdmin = Role::firstOrCreate(['name' => 'super-admin']);
        $roleAdmin->syncPermissions(Permission::all());
        
        // Assign super-admin to the first user
        $user = \App\Models\User::first();
        if ($user) {
            $user->assignRole('super-admin');
        }
    }
}
