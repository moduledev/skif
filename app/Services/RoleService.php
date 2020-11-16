<?php


namespace App\Services;


use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class RoleService extends BaseService
{
    public function __construct(Role $role)
    {
        parent::__construct($role);
    }
}
