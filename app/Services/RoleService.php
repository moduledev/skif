<?php


namespace App\Services;


use App\Http\Requests\UpdateRoleRequest;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;


class RoleService extends BaseService
{
    public function __construct(Role $role)
    {
        parent::__construct($role);
        $this->model = $role;
    }

    public function updateRole(UpdateRoleRequest $request, $id)
    {
        $role = $this->getById($id);
        $role->fill($request->all());
        $role->save();
        return $role;
    }

    public function assignRoleToAdmin(array $role, User $admin)
    {
        $admin->syncRoles($role);
    }
}
