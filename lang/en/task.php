<?php

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
    'selectMiner.dublicated' => 'The miners must not contain any duplicate names.',

    'selectScout.required' => 'The scout field is required.',
    'selectScout.array' => 'The selected scouts must be in an array.',
    'selectScout.exists' => 'One or more selected scouts are invalid.',
    'selectScout.unique' => 'The scouts must not contain duplicate entries.',
    'selectScout.dublicated' => 'The scouts must not contain any duplicate names.',

    'payoutRatio.required' => 'The payout ratio field is required.',
    'payoutRatio.numeric' => 'The payout ratio must be a number.',
    'payoutRatio.min' => 'The payout ratio must be at least 0.',
    'payoutRatio.max' => 'The payout ratio must be at most 100.',

    'oreTypes.required' => 'The ore type field in ore types is required.',
    'oreTypes.exists' => 'One or more selected ore types are invalid.',
    'oreUnits.required' => 'The ore unit field in ore types is required.',
    'oreUnits.numeric' => 'The ore unit in ore types must be a number.',
    'oreUnits.min' => "The units on postion :index must not be smaller then 1",
    'oreUnits.null' => "The units on postion :index must not be empty",

    'oldgroup.ratelimit' => 'Rate limit exceeded, just chill',
    'oldgroup.exists' => 'There are no old groups',

    'ratelimit.task.create' => 'You can only create a task every 30 seconds.',
    'task.create' => 'Task successfully created',

    'view.refinery' => 'Refinery',
    'view.refineryStation' => 'Refinery station',
    'view.method' => 'Method',
    'view.costs' => 'Costs',
    'view.duration' => 'Duration',
    'view.pleaseSelect' => 'Please select',

    'view.player' => 'Player',
    'view.oldGroup' => 'Previous Group',
    'view.payoutRatio' => 'Payout ratio',

    'view.hint' => 'Use the exact name (username) of a player. Then they are able to see the task too',

    'view.ores' => 'Ores',
    'view.oresType' => 'Ore type',
    'view.units' => 'Units',
    'view.addPart' => 'Additional share',
    'view.expectedProceeds' => 'Expected proceeds',

    'view.save' => 'Save',
    'view.saveToDashboard' => 'Save to dashboard',
    'view.reset' => 'Reset',
];
