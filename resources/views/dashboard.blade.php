@extends('layouts.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;900&display=swap" rel="stylesheet">

<style>
    body {
        background-color: #f3f7f9;
        font-family: 'Outfit', sans-serif;
    }

    .dashboard-wrapper {
        display: flex;
        min-height: 90vh;
        margin: 20px;
        background: #ffffff;
        border-radius: 40px;
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(0,0,0,0.05);
    }

    .sidebar {
        width: 280px;
        background-color: #fcfdfe;
        padding: 40px 20px;
        border-right: 1px solid #f0f0f0;
    }

    .sidebar-item {
        padding: 15px 20px;
        border-radius: 15px;
        margin-bottom: 10px;
        color: #8e9297;
        text-decoration: none;
        display: flex;
        align-items: center;
        transition: 0.3s;
    }

    .sidebar-item.active {
        background-color: #fff4e5;
        color: #ff9f43;
        font-weight: 600;
    }

    .main-content {
        flex: 1;
        padding: 40px;
    }

    .task-item {
        background: #ffffff;
        border-radius: 20px;
        padding: 18px 25px;
        margin-bottom: 15px;
        border: 1px solid #f8f9fa;
        display: flex;
        justify-content: space-between;
        align-items: center;
        transition: 0.3s;
        box-shadow: 0 4px 10px rgba(0,0,0,0.02);
    }

    .status-dot {
        height: 12px;
        width: 12px;
        border-radius: 50%;
        display: inline-block;
        margin-right: 15px;
        transition: transform 0.2s;
    }

    .status-dot:hover {
        transform: scale(1.3);
    }

    .glass-card {
        background: #ffffff;
        border-radius: 25px;
        border: 1px solid #f0f0f0;
        padding: 25px;
    }

    .btn-schedule {
        background: #c3f2d7;
        color: #27ae60;
        border: none;
        border-radius: 15px;
        padding: 12px;
        font-weight: 600;
        width: 100%;
    }
</style>

<div class="dashboard-wrapper">
    <div class="sidebar d-none d-md-block">
        <h4 class="fw-bold mb-5 ps-3">Ca Schedule</h4>
        <nav>
            <a href="{{ route('tasks.index') }}" class="sidebar-item active">Dashboard</a>
            <a href="#" class="sidebar-item">Mi Perfil</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="sidebar-item w-100 border-0 bg-transparent text-start">Salir</button>
            </form>
        </nav>
    </div>

    <div class="main-content">
        <div class="row">
            <div class="col-lg-8">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="fw-bold">Mis Tareas</h2>
                    <span class="text-muted">{{ now()->format('d M, Y') }}</span>
                </div>

                @forelse($tasks as $task)
                <div class="task-item" style="{{ $task->status == 'completada' ? 'opacity: 0.6;' : '' }}">
                    <div class="d-flex align-items-center">
                        <form action="{{ route('tasks.complete', $task) }}" method="POST" id="form-complete-{{ $task->id }}">
                            @csrf
                            @method('PATCH')
                            <span class="status-dot" 
                                  onclick="document.getElementById('form-complete-{{ $task->id }}').submit();"
                                  style="cursor: pointer; background-color: {{ $task->status == 'pendiente' ? '#ffcc00' : '#27ae60' }};"
                                  title="Marcar como completada">
                            </span>
                        </form>

                        <div>
                            <p class="mb-0 fw-bold {{ $task->status == 'completada' ? 'text-decoration-line-through text-muted' : 'text-dark' }}">
                                {{ $task->title }}
                            </p>
                            <small class="text-muted">{{ $task->course }}</small>
                        </div>
                    </div>
                    
                    <div class="text-end">
                        @if($task->status == 'completada')
                            <span class="badge bg-success text-white" style="border-radius: 10px;">¡Logrado!</span>
                        @else
                            <span class="badge" style="background: #f0f7ff; color: #72aee6; border-radius: 10px;">{{ $task->due_date }}</span>
                        @endif
                    </div>
                </div>
                @empty
                <div class="text-center py-5">
                    <img src="https://cdn-icons-png.flaticon.com/512/4076/4076432.png" width="80" class="mb-3" style="opacity: 0.3">
                    <p class="text-muted">No tienes tareas para mostrar.</p>
                </div>
                @endforelse
            </div>

            <div class="col-lg-4">
                <div class="glass-card shadow-sm">
                    <h5 class="fw-bold mb-4">Nueva Tarea</h5>
                    <form action="{{ route('tasks.store') }}" method="POST">
                        @csrf
                        <div class="mb-3 text-start">
                            <label class="small fw-bold text-muted">TÍTULO</label>
                            <input type="text" name="title" class="form-control border-0 bg-light" placeholder="Ej: Proyecto Final" required>
                        </div>
                        <div class="mb-3 text-start">
                            <label class="small fw-bold text-muted">MATERIA</label>
                            <input type="text" name="course" class="form-control border-0 bg-light" placeholder="Ej: Programación" required>
                        </div>
                        <div class="mb-3 text-start">
                            <label class="small fw-bold text-muted">FECHA</label>
                            <input type="date" name="due_date" class="form-control border-0 bg-light" required>
                        </div>
                        <button type="submit" class="btn-schedule mt-3">Guardar Actividad</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection