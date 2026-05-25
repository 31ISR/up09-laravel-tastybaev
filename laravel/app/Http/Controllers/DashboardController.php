<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        /** @var User $user */;
        $user = Auth::user();
        $tasks = $user->tasks();


        return view('dashboard', [
            'stats'=>[
                'total'=>$tasks->count(),
                'pending'=>$tasks->where('status','pending')->count(),
                'is_progress'=>$tasks->where('status','in_progress')->count(),
                'done'=> $tasks->where('status','done')->count()
            ],
            'recentTasks'=>$user->tasks()->with('category')->latest()
            ->take(5)->get(),
        ]);
    }
}
