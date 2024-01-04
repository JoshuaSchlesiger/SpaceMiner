<?php

return [

    'refineryStation.required' => 'null',
    'refineryStation.exists' => 'Die ausgewählte Raffineriestation ist ungültig.',

    'method.required' => 'null',
    'method.exists' => 'The selected method is invalid.',

    'costs.required' => 'null',
    'costs.numeric' => 'Die gewählte Methode ist ungültig.',

    'duration.required' => 'null',
    'duration.regex' => 'Die Dauer muss im Format HH::MM oder HHH::MM angegeben werden.',

    'selectMiner.required' => 'Es muss mindestens ein Miner eingegeben werden.',
    'selectMiner.array' => 'Die ausgewählten Miner müssen sich in einem Array befinden.',
    'selectMiner.min' => 'Es muss mindestens ein Miner eingegeben werden.',
    'selectMiner.exists' => 'Ein oder mehrere ausgewählte Miner sind ungültig.',
    'selectMiner.unique' => 'Die Miner dürfen keine doppelten Einträge enthalten.',
    'selectMiner.dublicated' => 'Die Miner dürfen keine doppelten Namen enthalten.',

    'selectScout.required' => 'Das Scout-Feld ist erforderlich.',
    'selectScout.array' => 'Die ausgewählten Scouts müssen sich in einer Reihe befinden.',
    'selectScout.exists' => 'Ein oder mehrere ausgewählte Scouts sind ungültig.',
    'selectScout.unique' => 'Die Scouts dürfen keine doppelten Einträge enthalten.',
    'selectScout.dublicated' => 'Die Scouts dürfen keine doppelten Namen enthalten.',

    'payoutRatio.required' => 'Das Feld Ausschüttungsquote ist erforderlich.',
    'payoutRatio.numeric' => 'Die Ausschüttungsquote muss eine Zahl sein.',
    'payoutRatio.min' => 'Die Ausschüttungsquote muss mindestens 0 % betragen..',
    'payoutRatio.max' => 'Die Ausschüttungsquote muss maximal 100 % betragen.',

    'oreTypes.required' => 'Das Feld Erzart in Erze ist erforderlich.',
    'oreTypes.exists' => 'Ein oder mehrere ausgewählte Erze sind ungültig.',
    'oreUnits.required' => 'Das Feld Einheiten in Erze ist erforderlich.',
    'oreUnits.numeric' => 'Die Einheiten in den Erzen muss eine Zahl sein.',
    'oreUnits.min' => "Das Element auf Position :index darf nicht kleiner als 1 sein",
    'oreUnits.null' => "Das Element an der Position :index darf nicht null sein",

    'oldgroup.ratelimit' => 'Ratengrenze überschritten, einfach abwarten',
    'oldgroup.exists' => 'Es gibt keine alten Gruppen',

    'ratelimit.task.create' => 'Sie können nur alle 30 Sekunden eine Aufgabe erstellen.',
    'task.create' => 'Auftrag erfolgreich erstellt',

    'view.refinery' => 'Raffinerie',
    'view.refineryStation' => 'Raffineriestation',
    'view.method' => 'Methode',
    'view.costs' => 'Kosten',
    'view.duration' => 'Dauer',
    'view.duration' => 'Dauer',
    'view.pleaseSelect' => 'Bitte auswählen',

    'view.player' => 'Spieler',
    'view.oldGroup' => 'Alte Gruppe',
    'view.payoutRatio' => 'Auszahlungsverhältnis',

    'view.ores' => 'Erze',
    'view.oresType' => 'Erzart',
    'view.units' => 'Einheiten',
    'view.addPart' => 'Weiterer Anteil',

    'view.save' => 'Speichern',
    'view.saveToDashboard' => 'Speichern und zum Dashboard',
    'view.reset' => 'Zurücksetzen',
];
