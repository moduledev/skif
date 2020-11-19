<?php


namespace App\Services;


use Illuminate\Database\Eloquent\Model;

class BaseService
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * BaseService constructor.
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }


    /**
     * Returns all records
     * @return \Illuminate\Database\Eloquent\Collection|Model[]
     */
    public function all()
    {
       return $this->model->all();
    }


    /**
     * Returns record by id
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
       return $this->model->findOrFail($id);
    }


    /**
     * @param $attributes
     * @return bool
     */
    public function add($attributes)
    {
      return  $this->model->fill($attributes->all())->save();
    }
}
