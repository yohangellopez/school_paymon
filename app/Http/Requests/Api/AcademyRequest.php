<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
class AcademyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        $academyId = $this->route('academy'); // Obtiene el ID desde la URL
        
        return [
            'name' => 'required|string|max:50|unique:academies,name,' . $academyId,
            'description' => 'nullable|string|max:255',
            'status' => 'sometimes|boolean'
        ];
    }

    public function messages(): array
    {
        return [
            'name.unique' => 'El nombre de la academia ya está registrado',
        ];
    }

    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(
            response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422)
        );
    }
}
