<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\PermissionService;
use App\Services\RoleService;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public $roleService;
    public $permissionService;

    /**
     * RoleController constructor.
     * @param RoleService $roleService
     * @param PermissionService $permissionService
     */
    public function __construct(RoleService $roleService, PermissionService $permissionService)
    {
        $this->roleService = $roleService;
        $this->permissionService = $permissionService;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $roles = $this->roleService->all();
        return view('admin.role.index', compact('roles'));
    }

    public function show($id)
    {
        $role = $this->roleService->getById($id);
        $permissions = $role->permissions;
        return view('admin.role.show',compact('role','permissions'));
    }

}
