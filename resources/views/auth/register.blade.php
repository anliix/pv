@extends('layouts.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500&family=Outfit:wght@700;900&display=swap" rel="stylesheet">

<style>
    body {
        background-color: #f0f7ff; /* Fondo celeste suave */
        font-family: 'Inter', sans-serif;
    }

    .register-container {
        min-height: 90vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    .register-card {
        background-color: #ffffff;
        border-radius: 30px; 
        border: none;
        width: 100%;
        max-width: 500px; /* Un poco más ancho para registro */
        padding: 50px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    }

    .register-title {
        font-family: 'Outfit', sans-serif;
        font-weight: 900;
        color: #1f1f1f;
        font-size: 2.8rem;
        letter-spacing: -1.5px;
        margin-bottom: 5px;
    }

    .register-subtitle {
        color: #72aee6;
        font-weight: 500;
        margin-bottom: 35px;
    }

    .form-control {
        border-radius: 15px;
        padding: 12px;
        border: 2px solid #f0f0f0;
        background-color: #fcfdfe;
        transition: 0.3s;
    }

    .form-control:focus {
        border-color: #72aee6;
        box-shadow: 0 0 0 0.25rem rgba(114, 174, 230, 0.1);
        background-color: #fff;
    }

    .btn-register {
        background-color: #0d6efd;
        color: white;
        border-radius: 50px;
        padding: 14px;
        font-weight: 600;
        font-family: 'Outfit', sans-serif;
        width: 100%;
        border: none;
        margin-top: 20px;
        box-shadow: 0 4px 15px rgba(13, 110, 253, 0.2);
        transition: 0.3s;
    }

    .btn-register:hover {
        background-color: #0b5ed7;
        transform: translateY(-2px);
    }
</style>

<div class="register-container">
    <div class="register-card text-center">
        
        <h3 class="register-title">ÚNETE</h3>
        <p class="register-subtitle">Crea tu cuenta académica hoy</p>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-3 text-start">
                <label class="form-label fw-bold small text-secondary">NOMBRE COMPLETO</label>
                <input id="name" type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Ej. Juan Pérez" required autofocus>
                @error('name') <span class="text-danger small">{{ $message }}</span> @enderror
            </div>

            <div class="mb-3 text-start">
                <label class="form-label fw-bold small text-secondary">CORREO ELECTRÓNICO</label>
                <input id="email" type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="usuario@escuela.com" required>
                @error('email') <span class="text-danger small">{{ $message }}</span> @enderror
            </div>

            <div class="mb-3 text-start">
                <label class="form-label fw-bold small text-secondary">CONTRASEÑA</label>
                <input id="password" type="password" name="password" class="form-control" placeholder="Mínimo 8 caracteres" required>
                @error('password') <span class="text-danger small">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4 text-start">
                <label class="form-label fw-bold small text-secondary">CONFIRMAR CONTRASEÑA</label>
                <input id="password_confirmation" type="password" name="password_confirmation" class="form-control" placeholder="Repite tu contraseña" required>
            </div>

            <button type="submit" class="btn-register">
                CREAR CUENTA
            </button>
        </form>

        <p class="mt-4 text-secondary small">
            ¿Ya tienes una cuenta? <a href="{{ route('login') }}" style="color: #72aee6; font-weight: 700; text-decoration: none;">Inicia Sesión</a>
        </p>
    </div>
</div>
@endsection