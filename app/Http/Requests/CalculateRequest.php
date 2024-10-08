<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CalculateRequest extends FormRequest
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
            "type" => ['string', Rule::in(['rock', 'ship'])],
            "massStone" => "integer",
            "oreTypes"  => ["array", "max:5"],
            "oreInput" => ["array", "max:5"],
            "refineryMethod" => "integer",
            "station" => "integer",
        ];
    }
}
