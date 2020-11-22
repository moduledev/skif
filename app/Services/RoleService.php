<?php


namespace App\Services;


use App\Models\User;
use Spatie\Permission\Models\Role;

class RoleService extends BaseService
{
    public function __construct(Role $role)
    {
        parent::__construct($role);
        $this->model = $role;
    }

    public function assignRoleToAdmin(array $role, User $admin)
    {
        $admin->syncRoles($role);
    }
}
