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
                    <div class="col-sm-5 col-md-3 fs-5 d-flex justify-content-evenly">
                        <div class="text-white-50">@lang('dashboard.view.runningTask.station'):</div>
                        <div class="ms-2 text-center">{{ $stations[$task['id']]->name }}</div>
                    </div>
                    <div class="col-sm-5 col-md-3 fs-5 d-flex justify-content-evenly">
                        <div class="text-white-50">@lang('dashboard.view.runningTask.ores'):</div>
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
                    <div class="col-sm-5 col-md-3 fs-5 d-flex justify-content-evenly">
                        <div class="text-white-50">@lang('dashboard.view.runningTask.playercount'):</div>
                        <div class="ms-2 ">{{ count($tasks_users[$task['id']]) }}</div>
                    </div>
                    <div class="col-sm-5 col-md-3 fs-5 d-flex justify-content-evenly">
                        <div class="text-white-50">@lang('dashboard.view.runningTask.finishedOn'):</div>
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

        @if (!empty($taskOfOtherUsers))
            <div class="header-text card-header mb-3">
                <div class="text-center fs-4">
                    Geteilte Aufträge
                </div>
            </div>
        @endif
        @foreach ($taskOfOtherUsers as $id => $task)
            <div class="listItems bg-dark" wire:click.prevent='showModal({{ $id }}, "runningTask")'>
                <div class="row align-items-center ms-2 me-2">
                    <div class="col-sm-5 col-md-3 fs-5 d-flex justify-content-evenly">
                        <div class="text-white-50">@lang('dashboard.view.runningTask.station'):</div>
                        <div class="ms-2 text-center">{{ $task['taskInfoStation']->name }}</div>
                    </div>
                    <div class="col-sm-5 col-md-3 fs-5 d-flex justify-content-evenly">
                        <div class="text-white-50">@lang('dashboard.view.runningTask.ores'):</div>
                        <div class="ms-2" onclick="event.stopPropagation()">
                            <select class="form-select text-center form-select-sm">
                                @foreach ($task['taskInfoTasks_Ores'] as $task_ore)
                                    <option>
                                        {{ $task_ore->name }}: {{ $task_ore->units }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-5 col-md-3 fs-5 d-flex justify-content-evenly">
                        <div class="text-white-50">Auftragbesitzer:</div>
                        <div class="ms-2 ">{{ $task['taskInfoUser']->name }}</div>
                    </div>
                    <div class="col-sm-5 col-md-3 fs-5 d-flex justify-content-evenly">
                        <div class="text-white-50">@lang('dashboard.view.runningTask.finishedOn'):</div>
                        <div class="ms-2 ">{{ date('d.m.Y H:i', strtotime($task['taskInfo']->actualCompletionDate)) }}
                        </div>
                    </div>
                </div>
                <div class="mt-3 ms-5 me-4">
                    <div class="progress">
                        @if ($task['percentageCompletion'] <= 33)
                            <div class="progress-bar progress-bar-striped bg-danger" role="progressbar"
                                style="width:{{ $task['percentageCompletion'] }}%"></div>
                        @elseif ($task['percentageCompletion'] <= 66)
                            <div class="progress-bar progress-bar-striped bg-warning" role="progressbar"
                                style="width:{{ $task['percentageCompletion'] }}%"></div>
                        @else
                            <div class="progress-bar progress-bar-striped bg-success" role="progressbar"
                                style="width:{{ $task['percentageCompletion'] }}%"></div>
                        @endif
                    </div>
                </div>
            </div>
            <hr>
        @endforeach
    </div>
</div>
