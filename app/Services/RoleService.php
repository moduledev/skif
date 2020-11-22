<?php


namespace App\Services;


use App\Models\User;
use Spatie\Permission\Models\Role;

class RoleService extends BaseService
{
    public function __construct(Role $role)
    {
        parent::__construct($role);
    }

    public function assignRoleToAdmin(array $role, User $admin)
    {
        $admin->syncRoles($role);
    }

    public function getAllRoles()
    {
        return $this->model->all();
    }
}
