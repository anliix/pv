@extends('layouts.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

<style>
    body { background-color: #f3f7f9; font-family: 'Outfit', sans-serif; }

    .dashboard-wrapper {
        display: flex; min-height: 90vh; margin: 20px;
        background: #ffffff; border-radius: 40px;
        overflow: hidden; box-shadow: 0 20px 60px rgba(0,0,0,0.05);
    }

    .sidebar {
        width: 280px; background-color: #fcfdfe;
        padding: 40px 20px; border-right: 1px solid #f0f0f0;
    }

    .sidebar-item {
        padding: 15px 20px; border-radius: 15px; margin-bottom: 10px;
        color: #8e9297; text-decoration: none; display: flex;
        align-items: center; transition: 0.3s; font-weight: 500;
    }

    /* Color Púrpura para diferenciar de Tareas */
    .sidebar-item.active { background-color: #f3f0ff; color: #7c4dff; font-weight: 600; }

    .main-content { flex: 1; padding: 40px; }

    .exam-item {
        background: #ffffff; border-radius: 20px; padding: 18px 25px;
        margin-bottom: 15px; border: 1px solid #f8f9fa;
        display: flex; justify-content: space-between; align-items: center;
        transition: 0.3s; box-shadow: 0 4px 10px rgba(0,0,0,0.02);
    }

    .exam-checkbox {
        width: 22px; height: 22px; cursor: pointer;
        accent-color: #7c4dff; 
    }

    .text-completed { text-decoration: line-through; color: #adb5bd !important; }

    .btn-delete {
        color: #ffbaba; transition: 0.3s; border: none; background: none;
        font-size: 1.2rem;
    }

    .btn-delete:hover { color: #ff4d4d; transform: scale(1.1); }

    .glass-card {
        background: #ffffff; border-radius: 25px; border: 1px solid #f0f0f0;
        padding: 25px; box-shadow: 0 10px 30px rgba(0,0,0,0.02);
    }

    .form-control-custom {
        background-color: #f8fbff; border: 1px solid #eef2f6;
        border-radius: 12px; padding: 12px;
    }

    /* Botón con estilo púrpura */
    .btn-schedule {
        background: #efe9ff; color: #7c4dff; border: none;
        border-radius: 15px; padding: 12px; font-weight: 600; width: 100%;
    }
</style>

<div class="dashboard-wrapper">
    <div class="sidebar d-none d-md-block">
        <h4 class="fw-bold mb-5 ps-3">ACTIVIDADES</h4>
        <nav>
            <a href="{{ route('home.index') }}" class="sidebar-item">INICIO</a>
            <a href="{{ route('tasks.index') }}" class="sidebar-item">TAREAS</a>
            <a href="{{ route('exam.index') }}" class="sidebar-item active">EXÁMENES</a>
        <form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit" class="sidebar-item border-0 bg-transparent w-100 text-start" style="cursor: pointer;">
        <i class="bi bi-box-arrow-right me-2"></i> SALIR
    </button>
</form>
                @csrf
            </form>
        </nav>
    </div>

    <div class="main-content">
        <div class="row">
            <div class="col-lg-8">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="fw-bold">EXÁMENES PRÓXIMOS</h2>
                    <span class="text-muted">{{ now()->format('d M, Y') }}</span>
                </div>

                @forelse($exam_list as $exam)
                <div class="exam-item" style="{{ $exam->status == 'rendido' ? 'opacity: 0.6;' : '' }}">
                    <div class="d-flex align-items-center">
                        <input type="checkbox" class="exam-checkbox me-3" 
                               {{ $exam->status == 'rendido' ? 'checked' : '' }}
                               onchange="event.preventDefault(); document.getElementById('update-exam-{{ $exam->id }}').submit();">
                        
                        <form id="update-exam-{{ $exam->id }}" action="{{ route('exam.update', $exam) }}" method="POST" style="display: none;">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="{{ $exam->status == 'rendido' ? 'pendiente' : 'rendido' }}">
                        </form>

                        <div>
                            <p class="mb-0 fw-bold {{ $exam->status == 'rendido' ? 'text-completed' : 'text-dark' }}">
                                {{ $exam->subject }} 
                                @if($exam->percentage)
                                    <span class="badge ms-1" style="background: #f3f0ff; color: #7c4dff; font-size: 0.7rem;">{{ $exam->percentage }}%</span>
                                @endif
                            </p>
                            <small class="text-muted">{{ $exam->topic }}</small>
                        </div>
                    </div>

                    <div class="d-flex align-items-center">
                        <span class="badge me-3" style="background: #f3f0ff; color: #7c4dff; border-radius: 10px;">
                            {{ \Carbon\Carbon::parse($exam->date)->format('d/m') }}
                        </span>
                        
                        <form action="{{ route('exam.destroy', $exam) }}" method="POST" onsubmit="return confirm('¿Eliminar este examen?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete">
                                <i class="bi bi-trash3-fill"></i>
                            </button>
                        </form>
                    </div>
                </div>
                @empty
                <p class="text-muted text-center py-5">No tienes exámenes programados.</p>
                @endforelse
            </div>

            <div class="col-lg-4">
                <div class="glass-card">
                    <h5 class="fw-bold mb-4">NUEVO EXAMEN</h5>
                    <form action="{{ route('exam.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="small fw-bold text-muted">MATERIA</label>
                            <input type="text" name="subject" class="form-control form-control-custom" placeholder="Ej: Álgebra" required>
                        </div>
                        <div class="mb-3">
                            <label class="small fw-bold text-muted">TEMA</label>
                            <input type="text" name="topic" class="form-control form-control-custom" placeholder="Ej: Ecuaciones" required>
                        </div>
                        <div class="mb-3">
                            <label class="small fw-bold text-muted">PORCENTAJE (%)</label>
                            <input type="number" name="percentage" class="form-control form-control-custom" placeholder="Ej: 20">
                        </div>
                        <div class="mb-3">
                            <label class="small fw-bold text-muted">FECHA</label>
                            <input type="date" name="date" class="form-control form-control-custom" required>
                        </div>
                        <button type="submit" class="btn-schedule mt-2">REGISTRAR EXAMEN</button>
                    </form>
                </div>

               <div class="text-center mt--10">
                    <img src="https://i.pinimg.com/736x/7a/46/e4/7a46e4cf0a125bf3e7b0f590bf3e7ccb.jpg" 
                         alt="exa" 
                         style="max-width: 50%; border-radius: 20px; ">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection