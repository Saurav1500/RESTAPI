<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Http\Resources\TaskResource;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //using resource will help to make sensetive data safe
        return TaskResource::collection(Task::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
       $validate=$request->validate([
        'title'=>'required|string|max:255',
        'description'=>'nullable|string',
        'completed'=>'boolean',
       ]);

       $task=Task::create($validate);

       return (new TaskResource($task))
       ->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
        return new TaskResource($task);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        //validate
          $validate=$request->validate([
        'title'=>'required|string|max:255',
        'description'=>'nullable|string',
        'completed'=>'boolean',
       ]);

       $task->update($validate);
       return new TaskResource($task);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $task->delete();

        return response()->json(null,204);
    }
}
