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

    public function create($attributes)
    {
      return $this->model->create($attributes->all());
    }

    public function delete($id)
    {
        $model = $this->model->findOrFail($id);
        $model->delete();
        return $model;
    }

    public function update($id, $attributes)
    {
        $model = $this->getById($id);
        $model->update($attributes->all());
    }
}
