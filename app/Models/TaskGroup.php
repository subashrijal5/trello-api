<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaskGroup extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['title'];

    public function tasks()
    {
        return $this->hasMany(Task::class, 'task_group_id');
    }
}
