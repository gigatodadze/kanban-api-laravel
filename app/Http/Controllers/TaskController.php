<?php

namespace App\Http\Controllers;

use App\Http\Resources\TaskResource;
use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function getTaskById($id)
    {
        return new TaskResource(Task::findOrFail($id));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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
            'user_id' => 'required',
            'state_id' => 'required',
            'priority' => 'required',
            'name' => 'required',
            'description' => 'required',
        ]);

        return Task::create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * @param \App\Models\State $post
     * @param $id
     *
     * @return array
     */
    public function update(Task $task, Request $request)
    {
        $data = $request->validate([
            'user_id' => 'nullable',
            'state_id' => 'required',
            'priority' => 'required',
            'name' => 'required',
            'description' => 'required',
        ]);

        $success = $task->update($data);

        return [
            'success' => $success,
        ];
    }

    /**
     * @param \App\Http\Controllers\State $state
     *
     * @return array
     */
    public function destroy(State $state)
    {
        $success = $state->delete();

        return [
            'success' => $success,
        ];
    }
}
