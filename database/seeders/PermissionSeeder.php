<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{

    /**
     *
     */
    public function run()
    {
        //
        $permissions = [
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'user-show',

            'admin-list',
            'admin-create',
            'admin-edit',
            'admin-delete',
            'admin-show',

            'schedule-show',
            'schedule-edit',
            'schedule-delete',
            'schedule-create',

            'work-list',
            'work-create',
            'work-edit',
            'work-delete',
            'work-show',

            'permission-assign',
            'permission-revoke',

            'role-assign',
            'role-revoke',
            'role-show',
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',


        ];
        foreach ($permissions as $permission) {
            Permission::updateOrCreate(['name' => $permission]);
        }

    }
}
