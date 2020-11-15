<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = Permission::all()->pluck('name');
        $roleAdmin = Role::updateOrCreate(['name' => 'super-admin']);
        Role::updateOrCreate(['name' => 'editor']);

        foreach ($permissions as $permission) {
            $roleAdmin->givePermissionTo($permission);
        }
        $admin = User::updateOrCreate(['name' => 'admin', 'surname' => 'Kupa', 'email' => 'admin@admin.com', 'password' => Hash::make('password')]);
        $user = User::updateOrCreate(['name' => 'Екатерина Байдуж', 'surname' => 'Bayduzh', 'email' => 'user@user.com', 'password' => Hash::make('12345678')]);

        if (!$admin->hasRole('super-admin')) {
            $admin->assignRole('super-admin');
        }

        if (!$admin) {
//            $user = Admin::updateOrCreate(['name' => 'admin', 'email' => 'admin@admin.com', 'password' => Hash::make('password')]);
            $admin->assignRole('super-admin');
        }

        if (!$user->hasRole('editor')) {
            $user->assignRole('editor');
        }

        if (!$user) {
//            $user = Admin::updateOrCreate(['name' => 'admin', 'email' => 'admin@admin.com', 'password' => Hash::make('password')]);
            $user->assignRole('editor');
        }
    }
}
