<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TodoController extends Controller
{
    use AuthorizesRequests;
    public function index(Request $request)
    {
        return $request->user()->todos;
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'description' => 'nullable',
        ]);

        $todo = $request->user()->todos()->create($data);

        return response()->json($todo);
    }

    public function show(Todo $todo)
    {
        $this->authorize('view', $todo);
        return $todo;
    }

    public function update(Request $request, Todo $todo)
    {
        $this->authorize('update', $todo);

        $data = $request->validate([
            'title' => 'sometimes|required',
            'description' => 'nullable',
            'is_done' => 'boolean',
        ]);

        $todo->update($data);

        return response()->json($request);
    }

    public function destroy(Todo $todo)
    {
        $this->authorize('delete', $todo);
        $todo->delete();

        return response()->json(['message' => 'Deleted']);
    }
}
