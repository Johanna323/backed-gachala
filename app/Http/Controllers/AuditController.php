<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Audit;
use Illuminate\Support\Facades\Validator;

class AuditController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Audit::with('user')->get(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'nullable|exists:users,id',
            'accion' => 'required|string|max:100',
            'fecha' => 'nullable|date',
            'descripcion' => 'nullable|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $audit = Audit::create($request->all());
        return response()->json($audit, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $audit = Audit::with('user')->find($id);
        if (!$audit) {
            return response()->json(['error' => 'Registro de auditoría no encontrado'], 404);
        }
        return response()->json($audit, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $audit = Audit::find($id);
        if (!$audit) {
            return response()->json(['error' => 'Registro de auditoría no encontrado'], 404);
        }
        $validator = Validator::make($request->all(), [
            'user_id' => 'nullable|exists:users,id',
            'accion' => 'sometimes|required|string|max:100',
            'fecha' => 'nullable|date',
            'descripcion' => 'nullable|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $audit->update($request->all());
        return response()->json($audit, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $audit = Audit::find($id);
        if (!$audit) {
            return response()->json(['error' => 'Registro de auditoría no encontrado'], 404);
        }
        $audit->delete();
        return response()->json(['message' => 'Registro de auditoría eliminado'], 200);
    }
}
