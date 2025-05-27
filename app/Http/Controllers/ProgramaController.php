<?php

namespace App\Http\Controllers;

use App\Models\Programa;
use Illuminate\Http\Request;

class ProgramaController extends Controller
{
    public function index()
    {
        return response()->json(Programa::all(), 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);
        $programa = Programa::create($request->all());
        return response()->json($programa, 201);
    }

    public function show($id)
    {
        $programa = Programa::find($id);
        if (!$programa) {
            return response()->json(['error' => 'Programa no encontrado'], 404);
        }
        return response()->json($programa, 200);
    }

    public function update(Request $request, $id)
    {
        $programa = Programa::find($id);
        if (!$programa) {
            return response()->json(['error' => 'Programa no encontrado'], 404);
        }
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);
        $programa->update($request->all());
        return response()->json($programa, 200);
    }

    public function destroy($id)
    {
        $programa = Programa::find($id);
        if (!$programa) {
            return response()->json(['error' => 'Programa no encontrado'], 404);
        }
        $programa->delete();
        return response()->json(['message' => 'Programa eliminado'], 200);
    }
} 