<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TipoDocumento;
use Illuminate\Http\Request;

class TipoDocumentoController extends Controller
{
    public function index()
    {
        try {
            $tiposDocumento = TipoDocumento::all();
            return response()->json([
                'status' => 'success',
                'data' => $tiposDocumento
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error al obtener los tipos de documento',
                'error' => $e->getMessage()
            ], 500);
        }
    }
} 