<?php

namespace App\Http\Controllers;

use App\Http\Resources\TaskResource;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return TaskResource::collection(Task::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Task $task, Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'state_id' => 'required|integer|exists:states,id',
            'priority' => 'required|integer|max:1',
            'name' => 'required|string|max:255',
            'description' => 'nullable|max:510',
        ]);

        return Task::create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Task $task
     *
     * @return \App\Http\Resources\TaskResource
     */
    public function show(Task $task)
    {
        return new TaskResource($task);
    }

    /**
     * @param \App\Models\Task $task
     * @param \Illuminate\Http\Request $request
     *
     * @return \App\Http\Resources\TaskResource
     */
    public function update(Task $task, Request $request)
    {
        $data = $request->validate([
            'user_id' => 'sometimes|required|integer|exists:users,id',
            'state_id' => 'sometimes|required|integer|exists:states,id',
            'priority' => 'sometimes|required|integer|max:1',
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|max:510',
        ]);

        return new TaskResource(tap($task)->update($data));
    }

    /**
     * @param \App\Models\Task $task
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return response()->noContent();
    }
}
