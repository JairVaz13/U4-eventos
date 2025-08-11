<?php

namespace App\Http\Controllers;

use App\Models\Asistente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AsistenteController extends Controller
{
    public function index()
    {
        $asistentes = Asistente::all();
        $respuesta = [
            'asistentes' => $asistentes,
            'status' => 200,
        ];
        return response()->json($respuesta);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:asistentes,email',
            'telefono' => 'nullable|string|max:15',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Datos faltantes o inválidos',
                'errors' => $validator->errors(),
                'status' => 400,
            ], 400);
        }

        $asistente = Asistente::create($request->all());

        if (!$asistente) {
            return response()->json([
                'message' => 'Error al crear el asistente',
                'status' => 500,
            ], 500);
        }

        return response()->json([
            'asistente' => $asistente,
            'status' => 201,
        ], 201);
    }

    public function show($id)
    {
        $asistente = Asistente::find($id);
        if (!$asistente) {
            return response()->json([
                'message' => 'Asistente no encontrado',
                'status' => 404,
            ], 404);
        }

        $respuesta = [
            'asistente' => $asistente,
            'status' => 200,
        ];
        return response()->json($respuesta);
    }

    public function update(Request $request, $id)
    {
        $asistente = Asistente::find($id);
        if (!$asistente) {
            return response()->json([
                'message' => 'Asistente no encontrado',
                'status' => 404,
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'nombre' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:asistentes,email,' . $asistente->id,
            'telefono' => 'nullable|string|max:15',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Datos faltantes o inválidos',
                'errors' => $validator->errors(),
                'status' => 400,
            ], 400);
        }

        $asistente->update($request->all());

        return response()->json([
            'asistente' => $asistente,
            'status' => 200,
        ]);
    }

    public function destroy($id)
    {
        $asistente = Asistente::find($id);
        if (!$asistente) {
            return response()->json([
                'message' => 'Asistente no encontrado',
                'status' => 404,
            ], 404);
        }

        $asistente->delete();

        return response()->json([
            'message' => 'Asistente eliminado correctamente',
            'status' => 200,
        ]);
    }
}
