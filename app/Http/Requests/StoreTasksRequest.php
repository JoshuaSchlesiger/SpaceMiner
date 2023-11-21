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
            'selectMiner' => 'required|array|min:1',
            'selectScouts' => 'sometimes|required|array',
            'payoutRatio' => 'required|numeric|min:0|max:100',
            'oreTypes' => 'required|exists:ores,id|array|min:1',
            'oreUnits' => 'required|array|min:1',
        ];
    }

    public function messages()
    {
        return [
            'refineryStation.required' => 'The refinery station field is required.',
            'refineryStation.exists' => 'The selected refinery station is invalid.',

            'method.required' => 'The method field is required.',
            'method.exists' => 'The selected method is invalid.',

            'costs.required' => 'The costs field is required.',
            'costs.numeric' => 'The costs must be a number.',

            'duration.required' => 'The duration field is required.',
            'duration.regex' => 'The duration must be in the format HH::MM or HHH::MM.',

            'selectMiner.required' => 'At least one miner must be inputed.',
            'selectMiner.array' => 'The selected miners must be in an array.',
            'selectMiner.min' => 'At least one miner must be inputed.',
            'selectMiner.exists' => 'One or more selected miners are invalid.',

            'selectScout.required' => 'The scout field is required.',
            'selectScout.array' => 'The selected scouts must be in an array.',
            'selectScout.exists' => 'One or more selected scouts are invalid.',

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
