<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateMovieRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'sometimes|required|string|max:255',
            'year' => 'sometimes|required|integer|min:1900|max:' . (date('Y') + 1),
            'director' => 'sometimes|required|string|max:255',
            'duration' => 'sometimes|required|integer|min:1',
            'poster' => 'sometimes|required|url|max:500',
            'genre' => 'sometimes|required|array|min:1',
            'genre.*' => 'required|string|max:50',
            'rate' => 'sometimes|required|numeric|min:0|max:10',
        ];
    }

    /**
     * Handle a failed validation attempt.
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'errors' => $validator->errors()
            ], 400)
        );
    }
}

