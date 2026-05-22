<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskFlow — @yield('title', 'Задачи')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('dashboard') }}">TaskFlow</a>
        @auth
        <div class="d-flex align-items-center gap-3">
            <a href="{{ route('tasks.index') }}" class="text-white text-decoration-none">Задачи</a>
            <a href="{{ route('categories.index') }}" class="text-white text-decoration-none">Категории</a>
            @if(auth()->user()->isAdmin())
                <span class="badge bg-warning text-dark">Admin</span>
            @endif
            <span class="text-white-50">{{ auth()->user()->name }}</span>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="btn btn-sm btn-outline-light">Выйти</button>
            </form>
        </div>
        @endauth
    </div>
</nav>

<main class="container py-4">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
  
    @yield('content')
</main>
</body>
</html>