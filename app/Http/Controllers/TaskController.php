<?php

namespace App\Http\Controllers;

use App\Models\Task;  // Task modelini import qilish
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(): \Illuminate\Database\Eloquent\Collection
    {
        return Task::all();  // Bu yerda Task modelidan foydalaniladi
    }

    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $task = Task::create($request->all());
        return response()->json($task, 201);
    }

    public function update(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        $task = Task::findOrFail($id);
        $task->update($request->all());
        return response()->json($task, 200);
    }

    public function destroy($id): \Illuminate\Http\JsonResponse
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return response()->json(null, 204);
    }
}
