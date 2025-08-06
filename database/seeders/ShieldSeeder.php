<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use BezhanSalleh\FilamentShield\Support\Utils;
use Spatie\Permission\PermissionRegistrar;


class ShieldSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $rolesWithPermissions = json_encode([
            [
                'name' => 'admin',
                'guard_name' => 'web',
                'permissions' => [
                    'view_any_order',
                    'view_order',
                    'create_order',
                    'update_order',
                    'delete_order',
                    'view_any_category',
                    'view_category',
                    'create_category',
                    'update_category',
                    'delete_category',
                    'view_any_product',
                    'view_product',
                    'create_product',
                    'update_product',
                    'delete_product',
                    'view_any_role',
                    'view_role',
                    'create_role',
                    'update_role',
                    'delete_role',
                    'view_any_user',
                    'view_user',
                    'create_user',
                    'update_user',
                    'delete_user',
                    'view_dashboard',
                    'view_accountwidget',
                    'view_filamentinfowidget',
                ],
            ],
        ]);
        $buyerRole = Role::firstOrCreate(['name' => 'buyer']);
        $buyerRole->syncPermissions([]);
        $directPermissions = '[]';

        static::makeRolesWithPermissions($rolesWithPermissions);
        static::makeDirectPermissions($directPermissions);

        $this->command->info('Shield Seeding Completed.');
    }

    protected static function makeRolesWithPermissions(string $rolesWithPermissions): void
    {
        if (! blank($rolePlusPermissions = json_decode($rolesWithPermissions, true))) {
            $roleModel = Utils::getRoleModel();
            $permissionModel = Utils::getPermissionModel();

            foreach ($rolePlusPermissions as $rolePlusPermission) {
                $role = $roleModel::firstOrCreate([
                    'name' => $rolePlusPermission['name'],
                    'guard_name' => $rolePlusPermission['guard_name'],
                ]);

                if (! blank($rolePlusPermission['permissions'])) {
                    $permissionModels = collect($rolePlusPermission['permissions'])
                        ->map(fn ($permission) => $permissionModel::firstOrCreate([
                            'name' => $permission,
                            'guard_name' => $rolePlusPermission['guard_name'],
                        ]))
                        ->all();

                    $role->syncPermissions($permissionModels);
                }
            }
        }
    }

    public static function makeDirectPermissions(string $directPermissions): void
    {
        if (! blank($permissions = json_decode($directPermissions, true))) {
            $permissionModel = Utils::getPermissionModel();

            foreach ($permissions as $permission) {
                if ($permissionModel::whereName($permission)->doesntExist()) {
                    $permissionModel::create([
                        'name' => $permission['name'],
                        'guard_name' => $permission['guard_name'],
                    ]);
                }
            }
        }
    }
}
