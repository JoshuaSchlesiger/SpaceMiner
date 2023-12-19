<div>
    @if ($successMessage)
        <div class="alert alert-success text-center" id="successMessage">
            {{ $successMessage }}
        </div>
    @endif
    <div>
        @foreach ($tasks as $task)
            <div class="listItems deletable" wire:click.prevent='showModal({{ $task['id'] }}, "runningTask")'>
                <div class="row align-items-center ms-2 me-2">
                    <div class="col fs-5 d-flex justify-content-evenly">
                        <div class="text-white-50">Station:</div>
                        <div class="ms-2 text-center">{{ $stations[$task['id']]->name }}</div>
                    </div>
                    <div class="col fs-5 d-flex justify-content-evenly">
                        <div class="text-white-50">Erze:</div>
                        <div class="ms-2" onclick="event.stopPropagation()">
                            <select class="form-select text-center form-select-sm">
                                @foreach ($tasks_ores[$task['id']] as $task_ore)
                                    <option>
                                        {{ $task_ore->name }}: {{ $task_ore->units }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col fs-5 d-flex justify-content-evenly">
                        <div class="text-white-50">Spieleranzahl:</div>
                        <div class="ms-2 ">{{ count($tasks_users[$task['id']]) }}</div>
                    </div>
                    <div class="col fs-5 d-flex justify-content-evenly">
                        <div class="text-white-50">Fertig am:</div>
                        <div class="ms-2 ">{{ date('d.m.Y H:i', strtotime($task['actualCompletionDate'])) }}</div>
                    </div>
                </div>
                <div class="mt-3 ms-5 me-4">
                    <div class="progress">
                        @if ($percentageCompletion[$task['id']] <= 33)
                            <div class="progress-bar progress-bar-striped bg-danger" role="progressbar"
                                style="width:{{ $percentageCompletion[$task['id']] }}%"></div>
                        @elseif ($percentageCompletion[$task['id']] <= 66)
                            <div class="progress-bar progress-bar-striped bg-warning" role="progressbar"
                                style="width:{{ $percentageCompletion[$task['id']] }}%"></div>
                        @else
                            <div class="progress-bar progress-bar-striped bg-success" role="progressbar"
                                style="width:{{ $percentageCompletion[$task['id']] }}%"></div>
                        @endif
                    </div>
                </div>
            </div>

            <hr>
        @endforeach
    </div>
</div>
