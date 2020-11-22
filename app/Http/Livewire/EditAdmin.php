<?php

namespace App\Http\Livewire;

use App\Http\Requests\AdminUpdateRequest;
use App\Models\User;
use App\Services\AdminService;
use App\Services\RoleService;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\Permission\Models\Role;

class EditAdmin extends Component
{
    use WithFileUploads;

    public $adminId;
    public $name;
    public $surname;
    public $email;
    public $phone;
    public $image_path;
    public $photo;
    public $admin;
    public $password;
    public $activate;
    public $roles;
    public $activeRoles;
    protected $adminService;
    protected $roleService;
    public $passedRole;

    public function mount(SessionManager $session, User $admin, $roles, AdminService $adminService, RoleService $roleService)
    {
        $this->adminId = $admin->id;
        $this->admin = $admin;
        $this->name = $admin->name;
        $this->surname = $admin->surname;
        $this->image_path = $admin->image_path;
        $this->email = $admin->email;
        $this->phone = $admin->phone;
        $this->photo = $admin->photo;
        $this->activate = $admin->activate;
        $this->roles = $roles;
        $this->activeRoles = [];
        $this->adminService = $adminService;
        $this->adminService = $roleService;
        $this->passedRole = '';

        $roles->map(function ($role) use ($admin) {
            if ($admin->hasRole($role->name)) {
                array_push($this->activeRoles, $role->name);
            }
            return $this->activeRoles;
        });

    }


    public function save(AdminService $adminService, RoleService $roleService)
    {
        $validatedData = $this->validate([
            'photo' => 'nullable|image|max:1024', // 1MB Max
            'name' => 'required|min:3',
            'surname' => 'required|min:3',
            'password' => 'nullable|min:8|max:20',
            'phone' => 'nullable|min:9',
            'email' => 'required',
            'activate' => 'boolean',
//            'roles' => 'array',
//            'activeRoles' => 'array'
        ]);

        $this->adminService = $adminService;
        $this->roleService = $roleService;
        $this->adminService->update($this->adminId, $validatedData);
        $this->roleService->assignRoleToAdmin($this->activeRoles, $this->admin);
        session()->flash('message', "Данные администратора успешно изменены");
    }


    protected function messages()
    {
        return [
            'name.required' => "Заполните поле имя!",
            'surname.required' => "Заполните поле фамилия!",
            'email.required' => 'Заполните поле имя E-mail!',
            'email.unique' => 'Email уже существует!',
            'password.min' => 'Длина пароля не менее 8 символов!',
            'phone.min' => 'Длина телефона не менее 9 символов!',
        ];
    }

    public function change()
    {
//       if($this->activeRoles->contains('name',$passedRole)){
//          $this->activeRoles =  $this->activeRoles->filter(function ($role) use($passedRole) {
//              if($role->name !== $passedRole){
//                  return $role;
//              }
//          });
//       } else {
//           $this->activeRoles->push($passedRole);
//           dd($this->activeRoles);
//       }
    }

    public function render()
    {
        return view('livewire.edit-admin');
    }
}
