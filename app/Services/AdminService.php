<?php


namespace App\Services;


use App\Models\User;

class AdminService extends BaseService
{
    /**
     * AdminService constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        parent::__construct($user);
        $this->model = $user;
    }

    public function getByIdWithRoles($id)
    {
        return $this->model->with('roles')->findOrFail($id)->get();
    }

}
