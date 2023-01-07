<?php
namespace App\Services;

use App\Models\TaskGroup;
use Illuminate\Database\Eloquent\Collection;

class TaskGroupService extends BaseService{

    public function __construct(TaskGroup $taskGroup)
    {
        $this->model = $taskGroup;
    }


    public function getData(array $filters = []): Collection
    {
        $query =  $this->model->with(['tasks'=> function($q) use($filters){
            return $q->filter($filters);
        }]);
        return $query->get();
    }

}
