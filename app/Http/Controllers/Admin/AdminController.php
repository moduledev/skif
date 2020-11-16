<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminStoreRequest;
use App\Http\Requests\AdminUpdateRequest;
use App\Models\User;
use App\Services\AdminService;
use App\Services\RoleService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public $adminService, $roleService;

    /**
     * AdminController constructor.
     * @param AdminService $adminService
     * @param RoleService $roleService
     */
    public function __construct(AdminService $adminService, RoleService $roleService)
    {
        $this->adminService = $adminService;
        $this->roleService = $roleService;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $admins = $this->adminService->all();
        return view('admin.admin.index', compact('admins'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $admin = $this->adminService->getById($id);
        return view('admin.admin.show', compact('admin'));
    }

    /**
     * Returns view create admin page
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $roles = $this->roleService->all();
        return view('admin.admin.create', compact('roles'));
    }

    public function store(AdminStoreRequest $request)
    {
        $this->adminService->add($request);
        return redirect()->route('admin.index')
            ->with('success', 'Администратор ' . $request->name . ' был успешно создан!');
    }

    public function edit($id)
    {

    }

    public function update(AdminUpdateRequest $request)
    {

    }
}
