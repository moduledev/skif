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


    public function add($attributes)
    {
        if ($attributes->file('image')) {
            $image_path = $this->storeImage('admin', $attributes->file('image'));
            $attributes->request->add(['image_path' => $image_path]);
        }
       return parent::create($attributes); // TODO: Change the autogenerated stub
    }

    public function update($id, array $attributes)
    {
        $admin = $this->model->findOrFail($id);
        if(isset($attributes['password'])) {
           $admin->password = $attributes['password'] ;
        } else {
            unset($attributes['password']);
        }
        $admin->fill($attributes);
        if ($admin->image_path && isset($attributes['photo'])) {
            unlink(storage_path('app/public' . '/' . $admin->image_path));
            $admin->image_path = $this->storeImage('admin', $attributes['photo']);
        } elseif (!$admin->image_path && isset($attributes['photo'])) {
            $admin->image_path = $this->storeImage('admin', $attributes['photo']);
        }
        $admin->save();
    }
}
