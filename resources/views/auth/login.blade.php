@extends('layouts.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500&family=Outfit:wght@700;900&display=swap" rel="stylesheet">

<style>
    body {
        /* Cambio a un fondo celeste muy suave y moderno */
        background-color: #f0f7ff; 
        font-family: 'Inter', sans-serif;
    }

    .login-container {
        min-height: 90vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .login-card {
        /* Recuadro Blanco con bordes redondeados */
        background-color: #ffffff;
        border-radius: 30px; 
        border: none;
        width: 100%;
        max-width: 450px;
        padding: 50px;
        /* Sombra suave para dar profundidad */
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    }

    .login-title {
        font-family: 'Outfit', sans-serif;
        font-weight: 900;
        color: #1f1f1f;
        font-size: 2.8rem;
        letter-spacing: -1.5px;
        margin-bottom: 5px;
    }

    .login-subtitle {
        color: #72aee6;
        font-weight: 500;
        margin-bottom: 35px;
        font-size: 1.1rem;
    }

    .form-control {
        border-radius: 15px;
        padding: 14px;
        border: 2px solid #f0f0f0;
        background-color: #fcfdfe;
        transition: 0.3s;
    }

    .form-control:focus {
        border-color: #72aee6;
        box-shadow: 0 0 0 0.25rem rgba(114, 174, 230, 0.1);
        background-color: #fff;
    }

    .btn-login {
        background-color: #0d6efd;
        color: white;
        border-radius: 50px;
        padding: 14px;
        font-weight: 600;
        font-family: 'Outfit', sans-serif;
        width: 100%;
        border: none;
        margin-top: 15px;
        box-shadow: 0 4px 15px rgba(13, 110, 253, 0.2);
        transition: 0.3s;
    }

    .btn-login:hover {
        background-color: #0b5ed7;
        transform: translateY(-2px);
    }

    .forgot-password {
        color: #72aee6;
        text-decoration: none;
        font-size: 0.9rem;
        font-weight: 600;
    }
</style>

<div class="login-container">
    <div class="login-card text-center">
        
        <h3 class="login-title">HOLA</h3>
        <p class="login-subtitle">Ingresa a tu cuenta académica</p>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3 text-start">
                <label class="form-label fw-bold small text-secondary" style="letter-spacing: 1px;">CORREO ELECTRÓNICO</label>
                <input type="email" name="email" class="form-control" placeholder="usuario@escuela.com" required>
            </div>

            <div class="mb-4 text-start">
                <label class="form-label fw-bold small text-secondary" style="letter-spacing: 1px;">CONTRASEÑA</label>
                <input type="password" name="password" class="form-control" placeholder="••••••••" required>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="remember">
                    <label class="form-check-label small text-muted" for="remember">Recordarme</label>
                </div>
                <a href="#" class="forgot-password">¿Olvidaste tu clave?</a>
            </div>

            <button type="submit" class="btn-login">
                INICIAR SESIÓN
            </button>
        </form>

        <p class="mt-5 text-secondary small">
            ¿No tienes cuenta? <a href="{{ route('register') }}" style="color: #72aee6; font-weight: 700; text-decoration: none;">Crea una aquí</a>
        </p>
    </div>
</div>
@endsection