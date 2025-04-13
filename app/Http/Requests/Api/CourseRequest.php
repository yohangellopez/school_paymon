<?php

namespace App\Http\Requests\Api;

use App\Enum\Course\CourseModalityEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CourseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $courseId = $this->route('course'); // Obtiene el ID del curso desde la URL

        return [
            'academy_id' => 'required|exists:academies,id',
            'name' => 'required|string|max:100|unique:courses,name,' . $courseId,
            'description' => 'required|string|max:255',
            'cost' => 'required|numeric|min:0',
            'duration_hours' => 'required|integer|min:1',
            'modality' => [
                'required',
                Rule::enum(CourseModalityEnum::class)
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'academy_id.exists' => 'La academia seleccionada no existe',
            'name.unique' => 'El nombre del curso ya está registrado',
            'modality' => 'La modalidad debe ser: ' . implode(', ', CourseModalityEnum::values())
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        throw new \Illuminate\Http\Exceptions\HttpResponseException(
            response()->json([
                'message' => 'Error de validación',
                'errors' => $validator->errors()
            ], 422)
        );
    }
}
