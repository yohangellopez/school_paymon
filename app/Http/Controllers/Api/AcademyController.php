<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AcademyRequest;
use App\Models\Academy;

class AcademyController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(AcademyRequest $request)
    {
        try {
            $academy = Academy::create($request->validated());
            
            return response()->json([
                'data' => $academy,
                'message' => 'Academia creada exitosamente'
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al crear la academia',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        try {
            $academy = Academy::find($id);
    
            if (!$academy) {
                return response()->json([
                    'message' => 'Academia no encontrada'
                ], 404);
            }
    
            return response()->json([
                'data' => $academy
            ]);
    
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al obtener la academia',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AcademyRequest $request, string $id)
    {
        try {
            $academy = Academy::find($id);
    
            if (!$academy) {
                return response()->json([
                    'message' => 'Academia no encontrada'
                ], 404);
            }
    
            // Actualiza solo los campos válidos
            $academy->update($request->validated());
    
            return response()->json([
                'data' => $academy,
                'message' => 'Academia actualizada exitosamente'
            ]);
    
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al actualizar la academia',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try {
            $academy = Academy::find($id);

            if (!$academy) {
                return response()->json([
                    'message' => 'Academia no encontrada'
                ], 404);
            }

            $academy->delete();

            return response()->json([
                'message' => 'Academia eliminada exitosamente'
            ], 204); // Código 204: No Content

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al eliminar la academia',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
