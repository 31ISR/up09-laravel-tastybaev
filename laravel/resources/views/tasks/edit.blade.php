@extends('layouts.app')
@section('title', 'Редактировать задачу')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-7">
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <h4 class="mb-4">Редактировать задачу</h4>
                <form action="{{ route('tasks.update', $task) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Заголовок</label>
                        <input type="text" name="title"
                            class="form-control @error('title') is-invalid @enderror"
                            value="{{ old('title', $task->title) }}" autofocus>
                        @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Описание</label>
                        <textarea name="description" rows="3"
                            class="form-control @error('description') is-invalid @enderror">{{ old('description', $task->description) }}</textarea>
                        @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            <label class="form-label">Статус</label>
                            <select name="status" class="form-select">
                                <option value="pending" {{ old('status', $task->status) === 'pending'     ? 'selected' : '' }}>Ожидает</option>
                                <option value="in_progress" {{ old('status', $task->status) === 'in_progress' ? 'selected' : '' }}>В работе</option>
                                <option value="done" {{ old('status', $task->status) === 'done'        ? 'selected' : '' }}>Готово</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Приоритет</label>
                            <select name="priority" class="form-select">
                                <option value="low" {{ old('priority', $task->priority) === 'low'    ? 'selected' : '' }}>Низкий</option>
                                <option value="medium" {{ old('priority', $task->priority) === 'medium' ? 'selected' : '' }}>Средний</option>
                                <option value="high" {{ old('priority', $task->priority) === 'high'   ? 'selected' : '' }}>Высокий</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Срок</label>
                            <input type="date" name="due_date"
                                class="form-control @error('due_date') is-invalid @enderror"
                                value="{{ old('due_date', $task->due_date?->format('Y-m-d')) }}">
                            @error('due_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Категория</label>
                        <select name="category_id" class="form-select">
                            <option value="">— Без категории —</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id', $task->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                        <a href="{{ route('tasks.index') }}" class="btn btn-outline-secondary">Отмена</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection