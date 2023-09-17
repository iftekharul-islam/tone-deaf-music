<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Constants\RolesConstant;
use Spatie\Permission\Models\Role;
use App\Constants\PermissionConstant;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $modules = [
            'Dashboard' => [
                [
                    'name' => PermissionConstant::DASHBOARD_ACCESS,
                ],
            ],

            'Users' => [
                [
                    'name' => PermissionConstant::USERS_ACCESS,
                ],
                [
                    'name' => PermissionConstant::USERS_CREATE,
                ],
                [
                    'name' => PermissionConstant::USERS_VIEW,
                ],
                [
                    'name' => PermissionConstant::USERS_UPDATE,
                ],
                [
                    'name' => PermissionConstant::USERS_DELETE,
                ],
            ],


            'Venue' => [
                [
                    'name' => PermissionConstant::VENUES_ACCESS,
                ],
                [
                    'name' => PermissionConstant::VENUES_CREATE,
                ],
                [
                    'name' => PermissionConstant::VENUES_VIEW,
                ],
                [
                    'name' => PermissionConstant::VENUES_UPDATE,
                ],
                [
                    'name' => PermissionConstant::VENUES_DELETE,
                ],
            ],
            'Staff' => [
                [
                    'name' => PermissionConstant::STAFF_ACCESS,
                ],
                [
                    'name' => PermissionConstant::STAFF_CREATE,
                ],
            ],
        ];

        foreach ($modules as $key => $permissions) {
            foreach ($permissions as $permission) {
                Permission::updateOrCreate([
                    'name' => $permission['name'],
                ], [
                    'name' => $permission['name'],
                ]);
            }
        }

        // ADMIN
        $roleAdmin = Role::updateOrCreate(
            [
                'name' => RolesConstant::ADMIN
            ],
            [
                'name' => RolesConstant::ADMIN,
            ]
        );
        $roleAdmin->givePermissionTo([
            PermissionConstant::DASHBOARD_ACCESS,
            PermissionConstant::USERS_ACCESS,
            PermissionConstant::USERS_CREATE,
            PermissionConstant::USERS_VIEW,
            PermissionConstant::USERS_UPDATE,
            PermissionConstant::USERS_DELETE,
        ]);

        // VENUE_MANAGERS
        $roleManager = Role::updateOrCreate(
            [
                'name' => RolesConstant::VENUE_MANAGERS
            ],
            [
                'name' => RolesConstant::VENUE_MANAGERS,
            ]
        );

        $roleManager->givePermissionTo([
            PermissionConstant::DASHBOARD_ACCESS,
            PermissionConstant::VENUES_ACCESS,
            PermissionConstant::VENUES_CREATE,
            PermissionConstant::VENUES_VIEW,
            PermissionConstant::VENUES_UPDATE,
            PermissionConstant::VENUES_DELETE,
            PermissionConstant::STAFF_ACCESS,
            PermissionConstant::STAFF_CREATE,
        ]);

        // VENUE_STAFF
        $roleStaff = Role::updateOrCreate([
            'name' => RolesConstant::VENUE_STAFF,
        ], [
            'name' => RolesConstant::VENUE_STAFF,
        ]);

        $roleStaff->givePermissionTo([
            PermissionConstant::DASHBOARD_ACCESS,
            PermissionConstant::VENUES_ACCESS,
            PermissionConstant::VENUES_VIEW,
            PermissionConstant::VENUES_UPDATE,
        ]);

        // USER
        $roleUser = Role::updateOrCreate([
            'name' => RolesConstant::USER,
        ], [
            'name' => RolesConstant::USER,
        ]);
        $roleUser->givePermissionTo([
            PermissionConstant::DASHBOARD_ACCESS,
        ]);
    }
}
