<?php

namespace App\Http\Controllers;

use App\Http\Resources\TaskCollection;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = new TaskCollection(Task::all());

        return response()->json($tasks, 200);
    }


    public function store(Request $request)
    {
        $task = Task::create([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return response()->json([
            'task' => new TaskResource($task),
            'message' => 'Has been created',
            'code' => 201
        ], 201);
    }

    public function show(Task $task)
    {
        return response()->json([
            'task' => new TaskResource($task),
            'code' => 200
        ], 200);
    }

    public function update(Request $request, Task $task)
    {
        $task->fill($request->all())->save();

        return response()->json([
            'task' => new TaskResource($task),
            'message' => 'Has been updated',
            'code' => 201
        ], 201);
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return response()->json([
            'message' => 'Has been deleted',
            'code' => 200
        ], 200);
    }

}
