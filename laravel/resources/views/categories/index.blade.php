@extends('layouts.app')
@section('title', 'Категории')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Категории</h1>
    <a href="{{ route('categories.create') }}" class="btn btn-primary">+ Новая категория</a>
</div>

@forelse($categories as $category)
    <div class="card mb-2">
        <div class="card-body d-flex justify-content-between align-items-center py-2">
            <div class="d-flex align-items-center gap-3">
<span @style(['background:' . $category->color, 'width:16px', 'height:16px', 'border-radius:50%', 'display:inline-block'])></span>                <span>{{ $category->name }}</span>
                <small class="text-muted">{{ $category->tasks_count }} задач</small>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('categories.edit', $category) }}" class="btn btn-sm btn-outline-secondary">Редактировать</a>
                <form action="{{ route('categories.destroy', $category) }}" method="POST"
                      onsubmit="return confirm('Удалить категорию?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger">Удалить</button>
                </form>
            </div>
        </div>
    </div>
@empty
    <p class="text-muted">Категорий пока нет.</p>
@endforelse
@endsection