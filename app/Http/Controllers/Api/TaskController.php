<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskCollection;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

/**
 * @group Task management
 *
 * APIs for managing Tasks
 */
class TaskController extends Controller
{
    /**
     * Get All Tasks
     *
     * This endpoint Gives you Tasks.
     * @authenticated
     */
    public function index()
    {
        $tasks = Auth::user()->tasks()->paginate();
        return new TaskCollection($tasks);
    }

    /**
     * Get Single Task
     *
     * This endpoint Gives Single Task.
     * @authenticated
     */
    public function show(Task $task)
    {

        return new TaskResource($task);
    }

    /**
     * Store a Task
     *
     * This endpoint stores Task.
     * @authenticated
     */
    public function store(StoreTaskRequest $request)
    {

        $task = Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'user_id' => Auth::id(),
        ]);

        return new TaskResource($task);
    }

    /**
     * Update a Task
     *
     * This endpoint Update Task.
     * @authenticated
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {

        $task->update($request->all());

        return new TaskResource($task);
    }

    /**
     * delete a Task
     *
     * This endpoint delete Task.
     * @authenticated
     */
    public function destroy(Task $task)
    {

        $task->delete();
        return response()->json(['message' => 'Task deleted successfully']);
    }
}
