<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EventoController extends Controller
{
    /**
     * Mostrar una lista del recurso.
     */
    public function index()
    {
        $eventos = Evento::all();

        return response()->json([
            'eventos' => $eventos,
            'status' => 200,
        ]);
    }

    /**
     * Almacenar un recurso recién creado.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'titulo' => 'required',
            'descripcion' => 'required',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
            'ubicacion' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Datos faltantes',
                'status' => 400,
            ], 400);
        }

        $evento = Evento::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'ubicacion' => $request->ubicacion,
        ]);

        if (!$evento) {
            return response()->json([
                'message' => 'Error al crear el evento',
                'status' => 500,
            ], 500);
        }

        return response()->json([
            'evento' => $evento,
            'status' => 201,
        ], 201);
    }

    /**
     * Mostrar un recurso específico.
     */
    public function show($id)
    {
        $evento = Evento::find($id);

        if (!$evento) {
            return response()->json([
                'message' => 'Evento no encontrado',
                'status' => 404,
            ], 404);
        }

        return response()->json([
            'evento' => $evento,
            'status' => 200,
        ]);
    }

    /**
     * Actualizar un recurso específico.
     */
    public function update(Request $request, $id)
    {
        $evento = Evento::find($id);

        if (!$evento) {
            return response()->json([
                'message' => 'Evento no encontrado',
                'status' => 404,
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'titulo' => 'required',
            'descripcion' => 'required',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
            'ubicacion' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Datos faltantes',
                'status' => 400,
            ], 400);
        }

        $evento->update([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'ubicacion' => $request->ubicacion,
        ]);

        return response()->json([
            'evento' => $evento,
            'status' => 200,
        ]);
    }

    /**
     * Eliminar un recurso específico.
     */
    public function destroy($id)
    {
        $evento = Evento::find($id);

        if (!$evento) {
            return response()->json([
                'message' => 'Evento no encontrado',
                'status' => 404,
            ], 404);
        }

        $evento->delete();

        return response()->json([
            'message' => 'Evento eliminado',
            'status' => 200,
        ]);
    }
}
