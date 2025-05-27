<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;
use Illuminate\Support\Facades\Validator;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Permission::all(), 200);
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
            'nombre' => 'required|string|max:50|unique:permissions,nombre',
            'descripcion' => 'nullable|string',
            'ruta' => 'nullable|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $permission = Permission::create($request->all());
        return response()->json($permission, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $permission = Permission::find($id);
        if (!$permission) {
            return response()->json(['error' => 'Permiso no encontrado'], 404);
        }
        return response()->json($permission, 200);
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
        $permission = Permission::find($id);
        if (!$permission) {
            return response()->json(['error' => 'Permiso no encontrado'], 404);
        }
        $validator = Validator::make($request->all(), [
            'nombre' => 'sometimes|required|string|max:50|unique:permissions,nombre,' . $id,
            'descripcion' => 'nullable|string',
            'ruta' => 'nullable|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $permission->fill($request->only(['nombre', 'descripcion', 'ruta']));
        $permission->save();
        $permission->refresh();
        return response()->json($permission, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permission = Permission::find($id);
        if (!$permission) {
            return response()->json(['error' => 'Permiso no encontrado'], 404);
        }
        $permission->delete();
        return response()->json(['message' => 'Permiso eliminado'], 200);
    }
}
