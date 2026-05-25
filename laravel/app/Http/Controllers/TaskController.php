<?php

namespace App\Http\Controllers;

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

    public function store(){
        $validate = $request-validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status'=>'required|in:pending, in_progress,done',
            'priority'=>'required|in:low,medium,high',
            'due_date' =>'nullable|date|after_or_equal"today',
            'category_id'=> 'nullable|exists:categories,id',
        ]);
    }

    public function create(){
        $user = Auth::user();
        $categories = $user->categories()->get();
        return view('tasks.create', compact('categories'));


    }

    public function edit(){

    }

    public function update(){

    }

    public function destroy(){
        
    }
}
