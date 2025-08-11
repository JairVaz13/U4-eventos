<?php

namespace App\Http\Controllers;

use App\Models\Ponente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PonenteController extends Controller
{
    public function index()
    {
        $ponentes = Ponente::all();

        return response()->json([
            'ponentes' => $ponentes,
            'status' => 200,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'biografia' => 'required|string',
            'especialidad' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Datos faltantes o inválidos',
                'errors' => $validator->errors(),
                'status' => 400,
            ], 400);
        }

        $ponente = Ponente::create($request->all());

        return response()->json([
            'ponente' => $ponente,
            'status' => 201,
        ], 201);
    }

    public function show($id)
    {
        $ponente = Ponente::find($id);
        if (!$ponente) {
            return response()->json([
                'message' => 'Ponente no encontrado',
                'status' => 404,
            ], 404);
        }

        return response()->json([
            'ponente' => $ponente,
            'status' => 200,
        ]);
    }

    public function update(Request $request, Ponente $ponente)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'sometimes|required|string|max:255',
            'biografia' => 'sometimes|required|string',
            'especialidad' => 'sometimes|required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Datos faltantes o inválidos',
                'errors' => $validator->errors(),
                'status' => 400,
            ], 400);
        }

        $ponente->update($request->only(['nombre', 'biografia', 'especialidad']));

        return response()->json([
            'ponente' => $ponente,
            'status' => 200,
        ]);
    }

    public function destroy($id)
    {
        $ponente = Ponente::find($id);
        if (!$ponente) {
            return response()->json([
                'message' => 'Ponente no encontrado',
                'status' => 404,
            ], 404);
        }

        $ponente->delete();

        return response()->json([
            'message' => 'Ponente eliminado correctamente',
            'status' => 200,
        ]);
    }
}
