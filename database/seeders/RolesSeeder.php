<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $buyerRole = Role::firstOrCreate(['name' => 'buyer']);

        $permissions = Permission::where('guard_name', 'web')->pluck('id')->toArray();
        $adminRole->syncPermissions($permissions);

        // Optionally, assign specific permissions to the buyer role if needed
        // $buyerRole->syncPermissions([]);


    }
}
