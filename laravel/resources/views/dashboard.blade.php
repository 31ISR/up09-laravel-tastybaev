@extends('layouts.app')
@section('title', 'Дашборд')
@section('content')
<h1 class="mb-4">Добро пожаловать, {{ auth()->user()->name }}!</h1>

<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card text-center border-0 bg-primary bg-opacity-10">
            <div class="card-body">
                <h2 class="mb-0">{{ $stats['total'] }}</h2>
                <small class="text-muted">Всего задач</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center border-0 bg-warning bg-opacity-10">
            <div class="card-body">
                <h2 class="mb-0">{{ $stats['pending'] }}</h2>
                <small class="text-muted">Ожидают</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center border-0 bg-info bg-opacity-10">
            <div class="card-body">
                <h2 class="mb-0">{{ $stats['in_progress'] }}</h2>
                <small class="text-muted">В работе</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center border-0 bg-success bg-opacity-10">
            <div class="card-body">
                <h2 class="mb-0">{{ $stats['done'] }}</h2>
                <small class="text-muted">Готово</small>
            </div>
        </div>
    </div>
</div>

<h5 class="mb-3">Последние задачи</h5>
@forelse($recentTasks as $task)
<div class="card mb-2">
    <div class="card-body d-flex justify-content-between align-items-center py-2">
        <span>{{ $task->title }}</span>
        <div class="d-flex gap-2 align-items-center">
            @if($task->category)
            <span class="badge" @style(['background-color: ' . $task->category->color])>
                        {{ $task->category->name }}
                    </span>
                @endif
                <span class="badge bg-{{ $task->status === 'done' ? 'success' : ($task->status === 'in_progress' ? 'warning' : 'secondary') }}">
                    {{ match($task->status) {
                        'pending'     => 'Ожидает',
                        'in_progress' => 'В работе',
                        'done'        => 'Готово',
                    } }}
                </span>
            </div>
        </div>
    </div>
@empty
    <p class="text-muted">Задач пока нет. <a href="{{ route('tasks.create') }}">Создать первую →</a></p>
@endforelse
@endsection