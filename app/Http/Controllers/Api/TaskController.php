<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\TaskFilterRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

class TaskController extends Controller
{

    public function __construct(protected TaskService $taskService)
    {
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TaskFilterRequest $request)
    {
        try {
            $tasks = $this->taskService->getData($request->validated());
            return $this->dataResponse(200, TaskResource::collection($tasks));
        } catch (\Throwable $th) {
            Log::error("Error in Task Module", [
                "message" => $th->getMessage(),
                "code" => $th->getCode() ?? 500,
                "context" => $th->__toString() ?? ''
            ]);
            return $this->errorResponse($th->getCode() ?? 500, $th->getMessage());
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTaskRequest $request)
    {
        $task = $this->taskService->store($request->validated());
        return $this->successResponse(201, "Task Created Successfully", TaskResource::make($task));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(StoreTaskRequest $request, $id)
    {
        try {
            $this->taskService->update($request->validated(), $id);
            return $this->successResponse(204, "Task Updated Successfully");
        } catch (\Throwable $th) {
            Log::error("Error in updating task Module", [
                "message" => $th->getMessage(),
                "code" => $th->getCode() ?? 500,
                "context" => $th->__toString() ?? ''
            ]);
            return $this->errorResponse($th->getCode() ?? 500, $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->taskService->delete($id);
            return $this->successResponse(200, "Task Deleted Successfully");
        } catch (\Throwable $th) {
            Log::error("Error in updating task Module", [
                "message" => $th->getMessage(),
                "code" => $th->getCode() ?? 500,
                "context" => $th->__toString() ?? ''
            ]);
            return $this->errorResponse($th->getCode() ?? 500, $th->getMessage());
        }
    }
}
