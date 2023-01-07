<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskGroupRequest;
use App\Http\Requests\TaskFilterRequest;
use App\Http\Resources\TaskGroupResource;
use App\Models\TaskGroup;
use App\Services\TaskGroupService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TaskGroupController extends Controller
{
    public function __construct(protected TaskGroupService $groupService)
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
            $tasks = $this->groupService->getData($request->validated());
            return $this->dataResponse(200, TaskGroupResource::collection($tasks));
        } catch (\Throwable $th) {
            Log::error("Error in Task Group Module", [
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
    public function store(StoreTaskGroupRequest $request)
    {
        $taskGroup =$this->groupService->store($request->validated());
        return $this->successResponse(201, "Task Created Successfully", TaskGroupResource::make($taskGroup));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TaskGroup  $taskGroup
     * @return \Illuminate\Http\Response
     */
    public function show(TaskGroup $taskGroup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TaskGroup  $taskGroup
     * @return \Illuminate\Http\Response
     */
    public function edit(TaskGroup $taskGroup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TaskGroup  $taskGroup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TaskGroup $taskGroup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TaskGroup  $taskGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->groupService->delete($id);
            return $this->successResponse(200, "Task Group Deleted Successfully");
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
