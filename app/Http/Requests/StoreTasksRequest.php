<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Lang;

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
                        $fail(Lang::get('task.selectMiner.dublicated'));
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
                            $fail(Lang::get('task.selectScout.dublicated'));
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
                        if($item < 1){
                            $fail(Lang::get('task.oreUnits.min', ['index' => $index]));
                        }
                        if ($item === null) {
                            $fail(Lang::get('task.oreUnits.null', ['index' => $index]));
                        }
                    }
                },
            ],
        ];
    }

    public function messages()
    {
        return [
            'refineryStation.required' => Lang::get('task.refineryStation.required'),
            'refineryStation.exists' => Lang::get('task.refineryStation.exists'),

            'method.required' => Lang::get('task.method.required'),
            'method.exists' => Lang::get('task.method.exists'),

            'costs.required' => Lang::get('task.costs.required'),
            'costs.numeric' => Lang::get('task.costs.numeric'),

            'duration.required' => Lang::get('task.duration.required'),
            'duration.regex' => Lang::get('task.duration.regex'),

            'selectMiner.required' => Lang::get('task.selectMiner.required'),
            'selectMiner.array' => Lang::get('task.selectMiner.array'),
            'selectMiner.min' => Lang::get('task.selectMiner.min'),
            'selectMiner.exists' => Lang::get('task.selectMiner.exists'),
            'selectMiner.unique' => Lang::get('task.selectMiner.unique'),

            'selectScout.required' => Lang::get('task.selectScout.required'),
            'selectScout.array' => Lang::get('task.selectScout.array'),
            'selectScout.exists' => Lang::get('task.selectScout.exists'),
            'selectScout.unique' => Lang::get('task.selectScouts.unique'),

            'payoutRatio.required' => Lang::get('task.payoutRatio.required'),
            'payoutRatio.numeric' => Lang::get('task.payoutRatio.numeric'),
            'payoutRatio.min' => Lang::get('task.payoutRatio.min'),
            'payoutRatio.max' => Lang::get('task.payoutRatio.max'),

            'oreTypes.required' => Lang::get('task.oreTypes.required'),
            'oreTypes.exists' => Lang::get('task.oreTypes.exists'),
            'oreUnits.required' => Lang::get('task.oreUnits.required'),
            'oreUnits.numeric' => Lang::get('task.oreUnits.numeric'),
        ];
    }
}
