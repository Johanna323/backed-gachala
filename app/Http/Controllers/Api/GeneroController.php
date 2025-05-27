<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Genero;
use Illuminate\Http\Request;

class GeneroController extends Controller
{
    public function index()
    {
        try {
            $generos = Genero::all();
            return response()->json([
                'status' => 'success',
                'data' => $generos
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error al obtener los géneros',
                'error' => $e->getMessage()
            ], 500);
        }
    }
} 