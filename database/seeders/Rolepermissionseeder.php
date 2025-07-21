<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class Rolepermissionseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create([
            'name' => 'admin-panel',
            'description' => 'Allows the system user to access the admin panel',
        ]);
        Permission::create([
            'name' => 'user-panel',
            'description' => 'Allows the system user to access the user panel',
        ]);
        Permission::create([
            'name' => 'dev-panel',
            'description' => 'Allows the user to access the user panel',
        ]);
        Permission::create([
            'name' => 'read-only',
            'description' => 'Allows the system user to access the read all data',
        ]);
        Permission::create([
            'name' => 'download',
            'description' => 'Allows the system user to access the download data',
        ]);
        Permission::create([
            'name' => 'employee-data',
            'description' => 'Allows the system user to access the employee data',
        ]);
        Permission::create([
            'name' => 'delete-data',
            'description' => 'Allows the system user to delete data',
        ]);

        Permission::create([
            'name' => 'approve-data',
            'description' => 'Allows the system user to approve data',
        ]);

        $role=Role::create(['name' => 'Superadmin']);
        $executive=Role::create(['name' => 'HR & Administration Executive']);
        $productionmanager=Role::create(['name' => 'Production Manager']);
        $productionstaff=Role::create(['name' => 'Production Staff']);
        $marketingmanager=Role::create(['name' => 'Marketing Manager']);
        $salesmanager=Role::create(['name' => 'Sales Manager']);
        $salesofficer=Role::create(['name' => 'Sales Officer']);
        $drivers=Role::create(['name' => 'Driver']);
        $coordinator=Role::create(['name' => 'Coordinator']);
        $hodIT=Role::create(['name' => 'HOD IT']);
        $accountant=Role::create(['name' => 'Accountant']);
        $assistenceaccountent=Role::create(['name' => 'Assistance accountant']);
        $materialimportcoordinator=Role::create(['name' => 'Material Import Coordinator']);

        $role->givePermissionTo(Permission::all());
        $executive->givePermissionTo([
            'admin-panel',

        ]);

        // Assign Permissions to Admin Role
        $productionmanager->givePermissionTo([
            'admin-panel',

        ]);
        $productionmanager->givePermissionTo([
            'admin-panel',

        ]);
        $productionstaff->givePermissionTo([
            'admin-panel',

        ]);
        $marketingmanager->givePermissionTo([
            'admin-panel',

        ]);
        $salesmanager->givePermissionTo([
            'admin-panel',

        ]);
        $salesofficer->givePermissionTo([
            'admin-panel',

        ]);
        $drivers->givePermissionTo([
            'admin-panel',

        ]);
        $coordinator->givePermissionTo([
            'admin-panel',

        ]);
        $hodIT->givePermissionTo([
            'admin-panel',

        ]);
        $accountant->givePermissionTo([
            'admin-panel',

        ]);
        $assistenceaccountent->givePermissionTo([
            'admin-panel',

        ]);
        $materialimportcoordinator->givePermissionTo([
            'admin-panel',

        ]);

    }
}
