<?php

namespace App\Http\Requests;

use App\Models\Ores;
use Illuminate\Foundation\Http\FormRequest;

class TaskProceeds extends FormRequest
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
            'refineryStation' => 'required|exists:stations,id',
            'method' => 'required|exists:methods,id',
            'oreTypes' => [
                'required',
                'array',
                'min:1',
                function ($attribute, $value, $fail) {
                    // Überprüfe, ob alle Werte in oreTypes in der Datenbank existieren
                    $existingOreTypes = Ores::pluck('id')->toArray();
                    foreach ($value as $oreType) {
                        if ($oreType !== 'null' && !in_array($oreType, $existingOreTypes)) {
                            $fail("");
                        }
                    }
                },
            ],
            'units' => [
                'required',
                'array',
                'min:1',
            ],
        ];
    }
}
