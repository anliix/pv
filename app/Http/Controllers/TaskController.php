<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        // Obtenemos las tareas del usuario logueado
        $tasks = Task::where('user_id', Auth::id())
                     ->orderBy('due_date', 'asc')
                     ->get();

        // Formateamos la fecha actual para el título del Dashboard
        $fecha = now()->format('F, Y'); 

        return view('tasks.index', compact('tasks', 'fecha'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'course' => 'required|string|max:255',
            'due_date' => 'required|date',
        ]);

        Task::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'course' => $request->course,
            'due_date' => $request->due_date,
            'notes' => $request->notes,
            'status' => 'pendiente',
        ]);

        return redirect()->route('tasks.index')->with('success', '¡Tarea agregada!');
    }
}