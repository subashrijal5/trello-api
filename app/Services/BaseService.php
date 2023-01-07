<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class BaseService
{

    protected $model;

    public function getData(array $filters = []): Collection
    {
        $query =  $this->model;
        if (count($filters)) {
            $query->where($filters);
        }
        return $query->get();
    }

    public function store(array $data): Model
    {
        return $this->model->create($data);
    }

    public function update(array $data, int $id): void
    {
        $this->find($id)->update($data);
    }

    public function find(int $id): Model
    {
        return $this->model->withTrashed()->findOrFail($id);
    }
    public function delete(int $id): void
    {
        $dat= $this->model->find($id);
        $dat->delete();
    }
}
