<?php

namespace App\Http\Livewire;

use App\Http\Requests\AdminUpdateRequest;
use App\Models\User;
use App\Services\AdminService;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

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
    public $password;
    public $activate;
    protected $adminService;

    public function mount(SessionManager $session, $admin, AdminService $adminService)
    {
        $this->adminId = $admin->id;
        $this->name = $admin->name;
        $this->surname = $admin->surname;
        $this->image_path = $admin->image_path;
        $this->email = $admin->email;
        $this->phone = $admin->phone;
        $this->photo = $admin->photo;
        $this->activate = $admin->activate;
        $this->adminService = $adminService;
    }

    public function save(AdminService $adminService)
    {
        $validatedData = $this->validate([
            'photo' => 'nullable|image|max:1024', // 1MB Max
            'name' => 'required|min:9',
            'surname' => 'required|min:3',
            'password' => 'nullable|min:8|max:20',
            'phone' => 'nullable|min:9',
            'email' => 'required',
            'activate' => 'boolean',
        ]);

        $this->adminService = $adminService;
        $this->adminService->update($this->adminId, $validatedData);
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

    public function render()
    {
        return view('livewire.edit-admin');
    }
}
