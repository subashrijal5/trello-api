<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ["title", "task_group_id", "description"];

    public function group()
    {
        return $this->belongsTo(TaskGroup::class, 'task_group_id');
    }

    public function scopeFilter($query, array $filters)
    {
        if (isset($filters['status'])) {
            if ($filters['status'] == 0) {
                $query->onlyTrashed();
            }
        } else {
            $query->withTrashed();
        }
        if(isset($filters['date']) && $filters['date']){
            $query->whereDate('created_at', $filters['date']);
        }
        unset($filters['status'], $filters['date']);
        if (count($filters)) {
            $query->where($filters);
        }
        return $query;
    }
}

