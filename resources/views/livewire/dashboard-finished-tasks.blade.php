<div>
    <div>
        <div class="header-text card-header">
            <div class="text-center fs-4">
                Fertige Aufträge
            </div>
        </div>
        <div class="card-body finishedTaskList">
            @foreach ($tasks as $task)
                <div class="row listItems align-items-center ms-2 me-2 @if($task['id'] == $this->selectedFinishedTaskID) bg-info bg-opacity-25 @endif " wire:click.prevent='showFinishedTaskInformation({{ $task['id'] }})'>
                    <div class="col-4 fs-5 d-flex justify-content-evenly">
                        <div class="text-white-50">Station:</div>
                        <div class="ms-2 text-info text-center">{{ $stations[$task['id']]->name }}</div>
                    </div>
                    <div class="col-3 fs-5 d-flex justify-content-evenly">
                        <div class="text-white-50">Spieleranzahl:</div>
                        <div class="ms-2 text-info">{{ count($tasks_users[$task['id']]) }}</div>
                    </div>
                    <div class="col-5 fs-5 d-flex justify-content-evenly">
                        <div class="text-white-50">Erze:</div>
                        <div class="ms-2">
                            <select class="form-select text-center form-select-sm">
                                @foreach ($tasks_ores[$task['id']] as $task_ore)
                                    <option>
                                        {{ $task_ore->name}}: {{ $task_ore->units}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <hr>
            @endforeach


        </div>
    </div>

    {{-- <div>
        <div class="header-text card-header text-center fs-4">
            <div class="text-center fs-4 my-auto">
                Spieler bezahlen
            </div>
        </div>
        <div class="card-body">

            <div class="row align-items-center ms-2 me-2 mt-2">
                <div class="col-lg-2"></div>
                <div class="col-lg-4 col-6 fs-4">
                    <div class="text-white-50">Spielername:</div>
                </div>
                <div class="col-lg-4 col-6 fs-4 text-info">
                    DochSergeantTV
                </div>
            </div>

            <div class="row align-items-center ms-2 me-2 mt-2">
                <div class="col-lg-2"></div>
                <div class="col-lg-4 col-6 fs-4">
                    <div class="text-white-50">Gesamtbetrag:</div>
                </div>
                <div class="col-lg-4 col-6">
                    <div class="ms-2 fs-4 text-center">
                        <span class="text-danger">23422</span> <span class="text-white-50">aUEC</span>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row align-items-center ms-2 me-2 mt-2">
                <div class="col-lg-2"></div>
                <div class="col-lg-4 col-6 fs-4">
                    <div class="text-white-50">Teilzahlung:</div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="ms-2">
                        <select class="form-select text-center">
                            <option value="" class="" hidden selected disabled>
                                Bitte wählen</option>
                            <option value="1">
                               234234 aUEC
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-1 col-6">
                    <button type="button" class="btn btn-outline-warning btn-sm">Teilzahlen</button>
                </div>
            </div>

            <div class="d-flex justify-content-evenly mt-4">
                <button type="button" class="btn btn-outline-success btn-lg">Gesamtzahlung</button>
                <button type="button" class="btn btn-outline-danger btn-lg">Abbrechen</button>
            </div>
        </div>
    </div> --}}
</div>
