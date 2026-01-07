<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    public function index()
    {
        // Usamos exam_list para que coincida con tu vista
        $exam_list = Exam::where('user_id', Auth::id())
                     ->orderBy('date', 'asc')
                     ->get();

        $fecha = now()->format('d M, Y'); 

        return view('exam.index', compact('exam_list', 'fecha'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'topic' => 'required|string|max:255',
            'percentage' => 'nullable|integer|min:0|max:100',
            'date' => 'required|date',
        ]);

        Exam::create([
            'user_id' => Auth::id(),
            'subject' => $request->subject,
            'topic' => $request->topic,
            'percentage' => $request->percentage,
            'date' => $request->date,
            'status' => 'pendiente',
        ]);

        // Redirigimos a la ruta en singular como pediste
        return redirect()->route('exam.index')->with('success', '¡Examen programado!');
    }

    public function update(Request $request, Exam $exam)
    {
        if ($exam->user_id !== auth()->id()) {
            abort(403);
        }

        $exam->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Estado del examen actualizado');
    }

    public function destroy(Exam $exam)
    {
        if ($exam->user_id !== auth()->id()) { 
            abort(403); 
        }

        $exam->delete();

        return back()->with('success', 'Examen eliminado correctamente');
    }
}