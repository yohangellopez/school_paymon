<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CourseRequest;
use App\Models\Course;
use Illuminate\Http\JsonResponse;

class CourseController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            $courses = Course::with('academy')->paginate(10);
            
            return response()->json([
                'data' => $courses,
                'message' => 'Cursos obtenidos exitosamente'
            ]);

        } catch (\Exception $e) {
            return $this->handleError($e);
        }
    }

    // Crear un nuevo curso
    public function store(CourseRequest $request): JsonResponse
    {
        try {
            $course = Course::create($request->validated());

            return response()->json([
                'data' => $course,
                'message' => 'Curso creado exitosamente'
            ], 201);

        } catch (\Exception $e) {
            return $this->handleError($e);
        }
    }

    // Obtener un curso específico
    public function show(int $id): JsonResponse
    {
        try {
            $course = Course::with('academy')->find($id);

            if (!$course) {
                return response()->json([
                    'message' => 'Curso no encontrado'
                ], 404);
            }

            return response()->json([
                'data' => $course,
                'message' => 'Curso obtenido exitosamente'
            ]);

        } catch (\Exception $e) {
            return $this->handleError($e);
        }
    }

    // Actualizar un curso
    public function update(CourseRequest $request, int $id): JsonResponse
    {
        try {
            $course = Course::find($id);

            if (!$course) {
                return response()->json([
                    'message' => 'Curso no encontrado'
                ], 404);
            }

            $course->update($request->validated());

            return response()->json([
                'data' => $course,
                'message' => 'Curso actualizado exitosamente'
            ]);

        } catch (\Exception $e) {
            return $this->handleError($e);
        }
    }

    // Eliminar un curso
    public function destroy(int $id): JsonResponse
    {
        try {
            $course = Course::find($id);

            if (!$course) {
                return response()->json([
                    'message' => 'Curso no encontrado'
                ], 404);
            }

            $course->delete();

            return response()->json([
                'message' => 'Curso eliminado exitosamente'
            ], 204);

        } catch (\Exception $e) {
            return $this->handleError($e);
        }
    }

    // Manejo centralizado de errores
    private function handleError(\Exception $e): JsonResponse
    {
        return response()->json([
            'message' => 'Error interno del servidor',
            'error' => $e->getMessage()
        ], 500);
    }
}
