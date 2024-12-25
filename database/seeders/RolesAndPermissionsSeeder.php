<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            // Create permissions
            $viewDashboard = Permission::create(['name' => 'view-dashboard']);
            $managePets = Permission::create(['name' => 'manage-pets']);
            $manageAppointments = Permission::create(['name' => 'manage-appointments']);
    
            // Create roles
            $admin = Role::create(['name' => 'admin']);
            $vet = Role::create(['name' => 'vet']);
            $receptionist = Role::create(['name' => 'receptionist']);
    
            // Assign permissions to roles
            $admin->givePermissionTo($viewDashboard);
            $vet->givePermissionTo($managePets);
            $receptionist->givePermissionTo($manageAppointments);
    }
}
