<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTasksRequest extends FormRequest
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
            'costs' => 'required|numeric',
            'duration' => 'required|regex:/^\d{1,3}:\d{2}$/',
            'selectMiner' => [
                'required',
                'array',
                'min:1',
                function ($attribute, $value, $fail) {
                    // Überprüfen auf doppelte Namen
                    $uniqueNames = array_unique($value);
                    if (count($value) !== count($uniqueNames)) {
                        $fail("Die Miner dürfen keine doppelten Namen enthalten.");
                    }
                },
            ],
            'selectScouts' => [
                'sometimes',
                'required',
                'array',
                function ($attribute, $value, $fail) {
                    // Überprüfen auf doppelte Namen
                    if ($value) {
                        $uniqueNames = array_unique($value);
                        if (count($value) !== count($uniqueNames)) {
                            $fail("Die Scouts dürfen keine doppelten Namen enthalten.");
                        }
                    }
                },
            ],
            'payoutRatio' => 'required|numeric|min:0|max:100',
            'oreTypes' => 'required|exists:ores,id|array|min:1',
            'oreUnits' => [
                'required',
                'array',
                'min:1',
                function ($attribute, $value, $fail) {
                    foreach ($value as $index => $item) {
                        if($item <= 1){
                            $fail("The element on postion $index must not be smaller then 1");
                        }
                        if ($item === null) {
                            $fail("The element on postion $index must not be null");
                        }
                    }
                },
            ],
        ];
    }

    public function messages()
    {
        return [
            'refineryStation.required' => 'null',
            'refineryStation.exists' => 'The selected refinery station is invalid.',

            'method.required' => 'null',
            'method.exists' => 'The selected method is invalid.',

            'costs.required' => 'null',
            'costs.numeric' => 'The costs must be a number.',

            'duration.required' => 'null',
            'duration.regex' => 'The duration must be in the format HH::MM or HHH::MM.',

            'selectMiner.required' => 'At least one miner must be inputed.',
            'selectMiner.array' => 'The selected miners must be in an array.',
            'selectMiner.min' => 'At least one miner must be inputed.',
            'selectMiner.exists' => 'One or more selected miners are invalid.',
            'selectMiner.unique' => 'The miners must not contain duplicate entries.',

            'selectScout.required' => 'The scout field is required.',
            'selectScout.array' => 'The selected scouts must be in an array.',
            'selectScout.exists' => 'One or more selected scouts are invalid.',
            'selectScouts.unique' => 'The scouts must not contain duplicate entries.',

            'payoutRatio.required' => 'The payout ratio field is required.',
            'payoutRatio.numeric' => 'The payout ratio must be a number.',
            'payoutRatio.min' => 'The payout ratio must be at least 0.',
            'payoutRatio.max' => 'The payout ratio must be at most 100.',

            'oreTypes.required' => 'The ore type field in ore types is required.',
            'oreTypes.exists' => 'One or more selected ore types are invalid.',
            'oreUnits.required' => 'The ore unit field in ore types is required.',
            'oreUnits.numeric' => 'The ore unit in ore types must be a number.',
        ];
    }
}
