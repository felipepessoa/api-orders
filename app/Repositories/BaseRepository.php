<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    public function create($data)
    {
        return $this->model->create($data);
    }

    public function update($id, $data)
    {
        $entity = $this->model->findOrFail($id);
        $entity->update($data);

        return $entity;
    }

    public function delete($id)
    {
        $entity = $this->model->findOrFail($id);
        $entity->delete();
    }
}
