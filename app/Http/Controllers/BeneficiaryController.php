<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Beneficiary;
use Illuminate\Support\Facades\Validator;

class BeneficiaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $beneficiaries = Beneficiary::with(['user', 'programa'])->get();
        $data = $beneficiaries->map(function($beneficiary) {
            $arr = $beneficiary->toArray();
            $arr['usuario'] = $beneficiary->user;
            $arr['programa'] = $beneficiary->programa;
            $arr['nombre_programa'] = $beneficiary->programa ? $beneficiary->programa->nombre : null;
            unset($arr['user']);
            unset($arr['programa']);
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
            'user_id' => 'required|exists:users,id',
            'estado_validacion' => 'nullable|string|max:20',
            'programa_id' => 'nullable|exists:programas,id',
            'fecha_registro' => 'nullable|date',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        // Validar que el usuario no esté ya registrado como beneficiario
        if (Beneficiary::where('user_id', $request->user_id)->exists()) {
            return response()->json(['error' => 'El usuario ya está registrado como beneficiario'], 409);
        }
        $beneficiary = Beneficiary::create($request->all());
        $beneficiary->load(['user', 'programa']);
        return response()->json($beneficiary, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $beneficiary = Beneficiary::with(['user', 'programa'])->find($id);
        if (!$beneficiary) {
            return response()->json(['error' => 'Beneficiario no encontrado'], 404);
        }
        $arr = $beneficiary->toArray();
        $arr['usuario'] = $beneficiary->user;
        $arr['programa'] = $beneficiary->programa;
        $arr['nombre_programa'] = $beneficiary->programa ? $beneficiary->programa->nombre : null;
        unset($arr['user']);
        unset($arr['programa']);
        return response()->json($arr, 200);
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
        $beneficiary = Beneficiary::find($id);
        if (!$beneficiary) {
            return response()->json(['error' => 'Beneficiario no encontrado'], 404);
        }
        $validator = Validator::make($request->all(), [
            'user_id' => 'sometimes|required|exists:users,id',
            'estado_validacion' => 'nullable|string|max:20',
            'programa_id' => 'nullable|exists:programas,id',
            'fecha_registro' => 'nullable|date',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $beneficiary->update($request->all());
        $beneficiary->load(['user', 'programa']);
        return response()->json($beneficiary, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $beneficiary = Beneficiary::find($id);
        if (!$beneficiary) {
            return response()->json(['error' => 'Beneficiario no encontrado'], 404);
        }
        $beneficiary->delete();
        return response()->json(['message' => 'Beneficiario eliminado'], 200);
    }
}
