<?php


namespace App\Services;


use App\Models\User;
use App\Traits\ImageStoreTrait;

class AdminService extends BaseService
{
    use ImageStoreTrait;

    /**
     * AdminService constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        parent::__construct($user);
        $this->model = $user;
    }

    public function update($id, array $attributes)
    {
        $admin = $this->model->findOrFail($id);
        $admin->fill($attributes);
        $admin->password = isset($attributes['password']) ? $attributes['password'] : $admin->password;
        if ($admin->image_path && isset($attributes['photo'])) {
            unlink(storage_path('app/public' . '/' . $admin->image_path));
//            $admin->image_path = $attributes['photo']->store('admin', 'public');
            $admin->image_path = $this->storeImage('admin', $attributes['photo']);
        } elseif (!$admin->image_path && isset($attributes['photo'])) {
//            $admin->image_path = $attributes['photo']->store('admin', 'public');
            $admin->image_path = $this->storeImage('admin', $attributes['photo']);

        }
        $admin->save();
    }
}
