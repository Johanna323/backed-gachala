<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = \App\Models\Role::get();
        $data = $roles->map(function($role) {
            $arr = $role->toArray();
            return $arr;
        });
        return response()->json($data, 200);
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
            'nombre' => 'required|string|max:50|unique:roles,nombre',
            'descripcion' => 'nullable|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $role = Role::create($request->all());
        return response()->json($role, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = \App\Models\Role::find($id);
        if (!$role) {
            return response()->json(['error' => 'Rol no encontrado'], 404);
        }
        return response()->json($role, 200);
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
        $role = Role::find($id);
        if (!$role) {
            return response()->json(['error' => 'Rol no encontrado'], 404);
        }
        $validator = Validator::make($request->all(), [
            'nombre' => 'sometimes|required|string|max:50|unique:roles,nombre,' . $id,
            'descripcion' => 'nullable|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $role->update($request->all());
        return response()->json($role, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::find($id);
        if (!$role) {
            return response()->json(['error' => 'Rol no encontrado'], 404);
        }
        $role->delete();
        return response()->json(['message' => 'Rol eliminado'], 200);
    }

    public function hasPermissionByName($roleId, $permissionName)
    {
        $role = \App\Models\Role::find($roleId);
        if (!$role) {
            return response()->json(['error' => 'Rol no encontrado'], 404);
        }
        // Buscar el permiso cuyo nombre coincida con el nombre del permiso dado y el nombre del rol
        $permiso = \App\Models\Permission::where('nombre', $permissionName)
            ->where('nombre', $role->nombre)
            ->first();
        $hasPermission = $permiso ? true : false;
        return response()->json([
            'has_permission' => $hasPermission,
            'permiso' => $permiso
        ], 200);
    }
}
