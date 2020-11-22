<?php


namespace App\Services;


use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;

class PermissionService extends BaseService
{
    /**
     * PermissionService constructor.
     * @param Permission $permission
     */
    public function __construct(Permission $permission)
    {
        parent::__construct($permission);
        $this->model = $permission;
    }
}
