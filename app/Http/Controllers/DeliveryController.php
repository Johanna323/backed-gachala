<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Delivery;
use Illuminate\Support\Facades\Validator;

class DeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $deliveries = Delivery::with(['beneficiary.user', 'kit', 'funcionario', 'sector'])->get();
        $data = $deliveries->map(function($delivery) {
            $arr = $delivery->toArray();
            $arr['beneficiario'] = $delivery->beneficiary;
            $arr['kit'] = $delivery->kit;
            $arr['funcionario'] = $delivery->funcionario;
            $arr['sector'] = $delivery->sector;
            $arr['nombre_usuario'] = $delivery->beneficiary && $delivery->beneficiary->user
                ? $delivery->beneficiary->user->primer_nombre . ' ' . $delivery->beneficiary->user->primer_apellido
                : null;
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
            'beneficiary_id' => 'required|exists:beneficiaries,id',
            'kit_id' => 'required|exists:kit_inventories,id',
            'fecha_entrega' => 'nullable|date',
            'funcionario_entrega' => 'nullable|exists:users,id',
            'observaciones' => 'nullable|string',
            'estado' => 'nullable|string|max:20',
            'sector_id' => 'nullable|exists:sectores,id',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $delivery = Delivery::create($request->all());
        $delivery->load(['beneficiary', 'kit', 'funcionario', 'sector']);
        return response()->json($delivery, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $delivery = Delivery::with(['beneficiary', 'kit', 'funcionario', 'sector'])->find($id);
        if (!$delivery) {
            return response()->json(['error' => 'Entrega no encontrada'], 404);
        }
        $arr = $delivery->toArray();
        $arr['beneficiario'] = $delivery->beneficiary;
        $arr['kit'] = $delivery->kit;
        $arr['funcionario'] = $delivery->funcionario;
        $arr['sector'] = $delivery->sector;
        $arr['nombre_usuario'] = $delivery->beneficiary && $delivery->beneficiary->user
            ? $delivery->beneficiary->user->primer_nombre . ' ' . $delivery->beneficiary->user->primer_apellido
            : null;
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
        $delivery = Delivery::find($id);
        if (!$delivery) {
            return response()->json(['error' => 'Entrega no encontrada'], 404);
        }
        $validator = Validator::make($request->all(), [
            'beneficiary_id' => 'sometimes|required|exists:beneficiaries,id',
            'kit_id' => 'sometimes|required|exists:kit_inventories,id',
            'fecha_entrega' => 'nullable|date',
            'funcionario_entrega' => 'nullable|exists:users,id',
            'observaciones' => 'nullable|string',
            'estado' => 'nullable|string|max:20',
            'sector_id' => 'nullable|exists:sectores,id',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $delivery->update($request->all());
        $delivery->load(['beneficiary', 'kit', 'funcionario', 'sector']);
        return response()->json($delivery, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delivery = Delivery::find($id);
        if (!$delivery) {
            return response()->json(['error' => 'Entrega no encontrada'], 404);
        }
        $delivery->delete();
        return response()->json(['message' => 'Entrega eliminada'], 200);
    }

    public function getByUserId($userId)
    {
        $beneficiary = \App\Models\Beneficiary::where('user_id', $userId)->first();
        if (!$beneficiary) {
            return response()->json(['error' => 'Beneficiario no encontrado para este usuario'], 404);
        }
        $deliveries = Delivery::with(['beneficiary.user', 'kit', 'funcionario', 'sector'])
            ->where('beneficiary_id', $beneficiary->id)
            ->get();
        $data = $deliveries->map(function($delivery) {
            $arr = $delivery->toArray();
            $arr['beneficiario'] = $delivery->beneficiary;
            $arr['kit'] = $delivery->kit;
            $arr['funcionario'] = $delivery->funcionario;
            $arr['sector'] = $delivery->sector;
            $arr['nombre_usuario'] = $delivery->beneficiary && $delivery->beneficiary->user
                ? $delivery->beneficiary->user->primer_nombre . ' ' . $delivery->beneficiary->user->primer_apellido
                : null;
            return $arr;
        });
        return response()->json($data, 200);
    }
}
