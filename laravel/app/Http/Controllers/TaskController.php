<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index(){
        $user = Auth::user();
        $tasks = $user->tasks()
            ->with('category')
            ->latest()
            ->paginate(10);

        return view('tasks.index', compact('tasks'));
    }

    public function store(Request $request)
{
    $data = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'status' => 'required|in:pending,in_progress,done',
        'priority' => 'required|in:low,medium,high',
        'due_date' => 'nullable|date|after_or_equal:now',
        'category_id' => 'nullable|exists:categories,id',
    ]);

    /** @var User $user */
    $user = Auth::user();
    $user = Auth::user();
    $user->tasks()->create($data);

    return redirect()->route('tasks.index')->with('success','Задача создана');
    }



    public function create(){
        $user = Auth::user();
        $categories = $user->categories()->get();
        return view('tasks.create', compact('categories'));


    }

    public function edit(Request $request, Task $task){
        $this->authorize('update', $task);

        $user=Auth::user();
        $categories = $user->categories()->get();
        return view('tasks.edit', compact('task', 'categories'));
    }

    public function update(Request $request, Task $task){

    $this->authorize('update',$task);

    $data = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'status' => 'required|in:pending,in_progress,done',
        'priority' => 'required|in:low,medium,high',
        'due_date' => 'nullable|date|after_or_equal:now',
        'category_id' => 'nullable|exists:categories,id',
    ]);

    $task->update($data);

    return redirect()->route('tasks.index')->with('success','Задача обновлена');
    }

    public function destroy(Task $task){
        $this->authorize('delete', $task);
        $task->delete();

        return redirect()->route('tasks.index')->with
        ('success', 'Задача удалена');
    }
}
