<?php


namespace App\Services;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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

    /**
     * @param Request $request
     * @param $role
     * @return \Illuminate\Http\RedirectResponse
     */
    public function assignPermission(Request $request, $role)
    {
        $validator = Validator::make($request->all(), [
            'permissions' => 'array'
        ]);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator);
        }
        $role->syncPermissions($request->permissions);

    }
}
