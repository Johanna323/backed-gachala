<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('role')->get();
        $data = $users->map(function($user) {
            $arr = $user->toArray();
            $arr['role_nombre'] = $user->role ? $user->role->nombre : null;
            unset($arr['contrasena']);
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
            'primer_nombre' => 'required|string|max:100',
            'segundo_nombre' => 'nullable|string|max:100',
            'primer_apellido' => 'required|string|max:100',
            'segundo_apellido' => 'nullable|string|max:100',
            'correo' => 'required|email|unique:users,correo',
            'contrasena' => 'required|string|min:6',
            'tipo_documento_id' => 'nullable|exists:tipo_documentos,id',
            'numero_documento' => 'nullable|string|max:30|unique:users,numero_documento',
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'nullable|string|max:255',
            'municipio' => 'nullable|string|max:100',
            'departamento' => 'nullable|string|max:100',
            'pais' => 'nullable|string|max:100',
            'fecha_nacimiento' => 'nullable|date_format:Y-m-d',
            'genero_id' => 'nullable|exists:generos,id',
            'activo' => 'boolean',
            'role_id' => 'nullable|exists:roles,id',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $data = $request->all();
        $data['contrasena'] = bcrypt($data['contrasena']);
        
        // Format fecha_nacimiento if it exists
        if (isset($data['fecha_nacimiento'])) {
            $data['fecha_nacimiento'] = date('Y-m-d', strtotime($data['fecha_nacimiento']));
        }
        
        $user = User::create($data);
        return response()->json($user, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::with('role')->find($id);
        if (!$user) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }
        $data = $user->toArray();
        $data['role_nombre'] = $user->role ? $user->role->nombre : null;
        unset($data['contrasena']);
        return response()->json($data, 200);
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
        $user = User::find($id);
        if (!$user) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }
        $validator = Validator::make($request->all(), [
            'primer_nombre' => 'sometimes|required|string|max:100',
            'segundo_nombre' => 'nullable|string|max:100',
            'primer_apellido' => 'sometimes|required|string|max:100',
            'segundo_apellido' => 'nullable|string|max:100',
            'correo' => 'sometimes|required|email|unique:users,correo,' . $id,
            'contrasena' => 'sometimes|nullable|string|min:6',
            'tipo_documento_id' => 'nullable|exists:tipo_documentos,id',
            'numero_documento' => 'nullable|string|max:30|unique:users,numero_documento,' . $id,
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'nullable|string|max:255',
            'municipio' => 'nullable|string|max:100',
            'departamento' => 'nullable|string|max:100',
            'pais' => 'nullable|string|max:100',
            'fecha_nacimiento' => 'nullable|date_format:Y-m-d',
            'genero_id' => 'nullable|exists:generos,id',
            'activo' => 'boolean',
            'role_id' => 'nullable|exists:roles,id',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $data = $request->all();
        if (isset($data['contrasena'])) {
            $data['contrasena'] = bcrypt($data['contrasena']);
        } else {
            unset($data['contrasena']);
        }

        // Format fecha_nacimiento if it exists
        if (isset($data['fecha_nacimiento'])) {
            $data['fecha_nacimiento'] = date('Y-m-d', strtotime($data['fecha_nacimiento']));
        }
        
        $user->update($data);
        return response()->json($user, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }
        $user->activo = 0;
        $user->save();
        return response()->json(['message' => 'Usuario desactivado (borrado lógico)'], 200);
    }

    /**
     * Login de usuario por documento y contraseña
     */
    public function login(Request $request)
    {
        $request->validate([
            'numero_documento' => 'required|string',
            'contrasena' => 'required|string',
        ]);
        $user = User::with('role')->where('numero_documento', $request->numero_documento)->first();
        if (!$user || !\Hash::check($request->contrasena, $user->contrasena)) {
            return response()->json(['error' => 'Credenciales inválidas'], 401);
        }
        $data = $user->toArray();
        $data['role_nombre'] = $user->role ? $user->role->nombre : null;
        unset($data['contrasena']);
        return response()->json($data, 200);
    }
}
