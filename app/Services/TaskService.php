<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;

class TaskService extends BaseService
{

    public function __construct(Task $task)
    {
        $this->model = $task;
    }

    public function getData(array $filters = []): Collection
    {
        $query =  $this->model->filter($filters);
        return $query->get();
    }
}
