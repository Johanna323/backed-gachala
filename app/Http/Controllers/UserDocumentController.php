<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserDocument;
use Illuminate\Support\Facades\Validator;

class UserDocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(UserDocument::all(), 200);
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
            'tipo_documento' => 'required|string|max:50',
            'url_archivo' => 'required|string|max:255',
            'fecha_carga' => 'nullable|date',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $doc = UserDocument::create($request->all());
        return response()->json($doc, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $doc = UserDocument::find($id);
        if (!$doc) {
            return response()->json(['error' => 'Documento no encontrado'], 404);
        }
        return response()->json($doc, 200);
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
        $doc = UserDocument::find($id);
        if (!$doc) {
            return response()->json(['error' => 'Documento no encontrado'], 404);
        }
        $validator = Validator::make($request->all(), [
            'user_id' => 'sometimes|required|exists:users,id',
            'tipo_documento' => 'sometimes|required|string|max:50',
            'url_archivo' => 'sometimes|required|string|max:255',
            'fecha_carga' => 'nullable|date',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $doc->update($request->all());
        return response()->json($doc, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $doc = UserDocument::find($id);
        if (!$doc) {
            return response()->json(['error' => 'Documento no encontrado'], 404);
        }
        $doc->delete();
        return response()->json(['message' => 'Documento eliminado'], 200);
    }
}
