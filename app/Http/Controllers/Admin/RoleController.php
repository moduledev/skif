<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Services\PermissionService;
use App\Services\RoleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
    public function create()
    {
        return view('admin.role.create');
    }

    public function store(CreateRoleRequest $request)
    {
        $role = $this->roleService->create($request);
        return redirect()->back()->with('success', 'Роль ' . $role->slug . ' была успешно создана!');
    }

    public function edit($id)
    {
        $role = $this->roleService->getById($id);
        $rolePermissions = $role->permissions;
        $permissions = $this->permissionService->all();
        return view('admin.role.edit', compact('role','permissions','rolePermissions'));
    }

    public function update(UpdateRoleRequest $request,$id)
    {
        $role = $this->roleService->updateRole($request, $id);
        $this->permissionService->assignPermission($request, $role);
        return redirect()->back()->with('success', 'Роль ' . $role->slug . ' был успешно изменен!');
    }

    public function destroy($id)
    {

    }

}
