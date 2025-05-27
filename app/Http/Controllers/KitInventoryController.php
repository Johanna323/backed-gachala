<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KitInventory;
use Illuminate\Support\Facades\Validator;

class KitInventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(KitInventory::all(), 200);
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
            'nombre_kit' => 'required|string|max:100',
            'descripcion' => 'nullable|string',
            'cantidad_disponible' => 'required|integer',
            'fecha_actualizacion' => 'nullable|date',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $kit = KitInventory::create($request->all());
        return response()->json($kit, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kit = KitInventory::find($id);
        if (!$kit) {
            return response()->json(['error' => 'Kit no encontrado'], 404);
        }
        return response()->json($kit, 200);
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
        $kit = KitInventory::find($id);
        if (!$kit) {
            return response()->json(['error' => 'Kit no encontrado'], 404);
        }
        $validator = Validator::make($request->all(), [
            'nombre_kit' => 'sometimes|required|string|max:100',
            'descripcion' => 'nullable|string',
            'cantidad_disponible' => 'sometimes|required|integer',
            'fecha_actualizacion' => 'nullable|date',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $kit->update($request->all());
        return response()->json($kit, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kit = KitInventory::find($id);
        if (!$kit) {
            return response()->json(['error' => 'Kit no encontrado'], 404);
        }
        $kit->delete();
        return response()->json(['message' => 'Kit eliminado'], 200);
    }
}
