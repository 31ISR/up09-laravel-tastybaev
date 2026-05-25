@extends('layouts.app')
@section('title', 'Мои задачи')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Мои задачи</h1>
    <a href="{{ route('tasks.create') }}" class="btn btn-primary">+ Новая задача</a>
</div>

<div class="row g-3">
    @forelse($tasks as $task)
    <div class="col-12">
        <div class="card">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-1">{{ $task->title }}</h5>
                    <div class="d-flex gap-2">
                        <span class="badge bg-{{ $task->status === 'done' ? 'success' : ($task->status === 'in_progress' ? 'warning' : 'secondary') }}">
                            {{ match($task->status) {
                                'pending'     => 'Ожидает',
                                'in_progress' => 'В работе',
                                'done'        => 'Готово',
                            } }}
                        </span>
                        @if($task->category)
                        <span class="badge" @style(['background-color: ' . $task->category->color])>
                        {{ $task->category->name }}
                            </span>
                        @endif
                        @if($task->due_date)
                            <small class="text-muted">до {{ $task->due_date->format('d.m.Y') }}</small>
                        @endif
                    </div>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('tasks.edit', $task) }}" class="btn btn-sm btn-outline-secondary">Редактировать</a>
                    <form action="{{ route('tasks.destroy', $task) }}" method="POST"
                          onsubmit="return confirm(' Удалить задачу?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">Удалить</button>
                            </form>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <p class="text-muted">Задач пока нет. <a href="{{ route('tasks.create') }}">Создать первую →</a></p>
        </div>
        @endforelse
    </div>

    <div class="mt-4">{{ $tasks->links() }}</div>
    @endsection