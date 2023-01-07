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
        $query =  $this->model;
        if (isset($filters['status'])) {
            if ($filters['status'] == 0) {
                $query->onlyTrashed();
            }
        } else {
            $query->withTrashed();
        }
        unset($filters['status'], $filters['date']);
        if (count($filters)) {
            $query->where($filters);
        }
        return $query->get();
    }
}
