@extends('layouts.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@700;900&display=swap" rel="stylesheet">

<style>
    /* Botones con los colores que pediste pero con estilo redondeado Gemini */
    .btn-custom-tareas { 
        background-color: #ff5722; 
        color: white; 
        border: none; 
        border-radius: 50px; 
        padding: 12px 30px; 
        font-weight: 600;
    }
    .btn-custom-examenes { 
        background-color: #4caf50; 
        color: white; 
        border: none; 
        border-radius: 50px; 
        padding: 12px 30px; 
        font-weight: 600;
    }
    .btn-custom-tareas:hover, .btn-custom-examenes:hover { 
        opacity: 0.9; 
        color: white; 
        transform: translateY(-2px);
        transition: 0.3s;
    }
    
    .hero-container {
        background-color: #ffffff;
        color: #1f1f1f;
        padding: 60px;
        border-radius: 30px; /* Bordes más redondeados como el login */
    }

    /* Clase corregida para aplicar la fuente Outfit al nombre */
    .titleusuario {
        font-family: 'Outfit', sans-serif;
        font-weight: 900;
        color: #0d6efd; /* Color celeste/azul */
        font-size: 5rem; /* Tamaño grande impacto */
        letter-spacing: -3px;
        margin-bottom: 0;
        line-height: 0.9;
    }

    .bienvenido-text {
        font-family: 'Outfit', sans-serif;
        font-weight: 400;
        color: #444;
        font-size: 1.8rem;
        margin-bottom: -10px;
    }
</style>

<div class="container mt-5">
    <div class="hero-container shadow-sm">
        <div class="row align-items-center">
            
            <div class="col-md-7 text-start">
                <h2 class="bienvenido-text">
                    Bienvenido,
                </h2>
                <br><br>
                <div class="titleusuario text-uppercase">
                    {{ Auth::user()->name ?? 'Usuario' }}
                </div>
                
                <p class="lead mt-4" style="color: #666; font-size: 1.3rem;">
                    Desde aquí puedes navegar a Tareas y Exámenes de manera sencilla.
                </p>
                
                <div class="mt-4">
                    <a href="{{ route('tasks.index') }}" class="btn btn-custom-tareas me-2 shadow-sm">Ir a Tareas</a>
                    <a href="{{ route('exam.index') }}" class="btn btn-custom-examenes shadow-sm">Ver Exámenes</a>
                </div>
            </div>

            <div class="col-md-5 text-end">
                <img src="https://i.pinimg.com/736x/30/84/2b/30842b5663165c1d42ea958de4316bf2.jpg" 
                     alt="Bienvenida" 
                     class="img-fluid" >

</div>
        </div>
    </div>
</div>
@endsection