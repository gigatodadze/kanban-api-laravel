<?php

namespace App\Http\Controllers;

use App\Http\Resources\StateResource;
use Illuminate\Http\Request;
use App\Models\State;
use Illuminate\Validation\Rule;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return StateResource::collection(State::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        return State::create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \App\Http\Resources\StateResource
     */
    public function show(State $state)
    {
        return new StateResource($state);
    }

    /**
     * @param \App\Models\State $state
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function update(State $state, Request $request)
    {
        $data = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'order' => 'sometimes|required|integer',
        ]);

        return [
            'success' => $success,
        ];
    }

    /**
     * @param \App\Models\State $post
     *
     * @return array
     */
    public function destroy(State $post)
    {
        $success = $post->delete();

        return [
            'success' => $success,
        ];
    }
}
