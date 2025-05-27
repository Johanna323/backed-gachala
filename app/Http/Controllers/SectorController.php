<?php

namespace App\Http\Controllers;

use App\Models\Sector;
use Illuminate\Http\Request;

class SectorController extends Controller
{
    public function index()
    {
        return response()->json(Sector::all(), 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);
        $sector = Sector::create($request->all());
        return response()->json($sector, 201);
    }

    public function show($id)
    {
        $sector = Sector::find($id);
        if (!$sector) {
            return response()->json(['error' => 'Sector no encontrado'], 404);
        }
        return response()->json($sector, 200);
    }

    public function update(Request $request, $id)
    {
        $sector = Sector::find($id);
        if (!$sector) {
            return response()->json(['error' => 'Sector no encontrado'], 404);
        }
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);
        $sector->update($request->all());
        return response()->json($sector, 200);
    }

    public function destroy($id)
    {
        $sector = Sector::find($id);
        if (!$sector) {
            return response()->json(['error' => 'Sector no encontrado'], 404);
        }
        $sector->delete();
        return response()->json(['message' => 'Sector eliminado'], 200);
    }
} 