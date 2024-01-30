<div>
    @if (!$userPayMode)
        <div>
            <div class="header-text card-header">
                <div class="text-center fs-4">
                    @empty($combinableTasks)
                        @lang('dashboard.view.finishedTask.header')
                    @else
                        @lang('dashboard.view.finishedTask.headerCombine')
                    @endempty
                </div>
            </div>
            <div class="card-body finishedTaskList">
                @forelse ($combinableTasks as $task)
                    <div class="row listItems align-items-center ms-2 me-2
                            @if ($task['id'] === $selectedFinishedTaskID) bg-info bg-opacity-25"
                            @elseif (in_array($task['id'], $combinableTasksIDs) && !$blockSelect) bg-success bg-opacity-25 no-pulse"  wire:click.prevent='deselectTask({{ $task['id'] }})'
                            @elseif ($blockSelect) bg-success bg-opacity-25 "
                            @else pulse " wire:click.prevent='combineTasks({{ $task['id'] }})' @endif>

                        <div class="col-sm-10 col-md-4 fs-5 d-flex justify-content-evenly">
                            <div class="text-white-50">@lang('dashboard.view.finishedTask.station'):</div>
                            <div class="ms-2 text-info text-center">{{ $stations[$task['id']]->name }}</div>
                        </div>
                        <div class="col-sm-10 col-md-3 fs-5 d-flex justify-content-evenly">
                            <div class="text-white-50">@lang('dashboard.view.finishedTask.playercount'):</div>
                            <div class="ms-2 text-info">{{ count($tasks_users[$task['id']]) }}</div>
                        </div>
                        <div class="col-sm-10 col-md-5 fs-5 d-flex justify-content-evenly">
                            <div class="text-white-50">@lang('dashboard.view.finishedTask.ores'):</div>
                            <div class="ms-2 w-100">
                                <select class="form-select text-center form-select-sm" onclick="event.stopPropagation()">
                                    @foreach ($tasks_ores[$task['id']] as $task_ore)
                                        <option>
                                            {{ $task_ore->name }}: {{ $task_ore->units }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <hr>
                @empty
                    @foreach ($tasks as $task)
                        <div class="row listItems align-items-center ms-2 me-2
                            @if ($task['id'] == $selectedFinishedTaskID) bg-info bg-opacity-25"
                            @else " wire:click.prevent='showFinishedTaskInformation({{ $task['id'] }})' @endif>

                            <div class="col-sm-10 col-md-4 fs-5 d-flex justify-content-evenly">
                                <div class="text-white-50">@lang('dashboard.view.finishedTask.station'):</div>
                                <div class="ms-2 text-info text-center">{{ $stations[$task['id']]->name }}</div>
                            </div>
                            <div class="col-sm-10 col-md-3 fs-5 d-flex justify-content-evenly">
                                <div class="text-white-50">@lang('dashboard.view.finishedTask.playercount'):</div>
                                <div class="ms-2 text-info">{{ count($tasks_users[$task['id']]) }}</div>
                            </div>
                            <div class="col-sm-10 col-md-5 fs-5 d-flex justify-content-evenly">
                                <div class="text-white-50">@lang('dashboard.view.finishedTask.ores'):</div>
                                <div class="ms-2 w-100">
                                    <select class="form-select text-center form-select-sm" onclick="event.stopPropagation()">
                                        @foreach ($tasks_ores[$task['id']] as $task_ore)
                                            <option>
                                                {{ $task_ore->name }}: {{ $task_ore->units }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr>
                    @endforeach
                @endforelse
            </div>

            @if (!empty($taskOfOtherUsers))
            <div class="header-text card-header mb-3 border-top">
                <div class="text-center fs-4">
                    @lang('dashboard.view.sharedFinishedTask.header')
                </div>
            </div>
            <div class="card-body finishedTaskListShared">
                @foreach ($taskOfOtherUsers as $id => $task)
                    <div class="row listItems align-items-center ms-2 me-2" wire:click.prevent='showModal({{ $id }}, "runningTaskOther")'>
                        <div class="col-sm-10 col-md-4 fs-5 d-flex justify-content-evenly">
                            <div class="text-white-50">@lang('dashboard.view.finishedTask.station'):</div>
                            <div class="ms-2 text-info text-center">{{ $task['taskInfoStation']->name }}</div>
                        </div>
                        <div class="col-sm-10 col-md-4 fs-5 d-flex justify-content-evenly">
                            <div class="text-white-50">@lang('dashboard.view.taskCreator'):</div>
                            <div class="ms-2 ">{{ $task['taskInfoUser']->name }}</div>
                        </div>
                        <div class="col-sm-10 col-md-4 fs-5 d-flex justify-content-evenly">
                            <div class="text-white-50">@lang('dashboard.view.finishedTask.ores'):</div>
                            <div class="ms-2 w-100">
                                <select class="form-select text-center form-select-sm" onclick="event.stopPropagation()">
                                    @foreach ($task['taskInfoTasks_Ores'] as $task_ore)
                                        <option>
                                            {{ $task_ore->name }}: {{ $task_ore->units }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <hr>
                @endforeach
            </div>
        @endif
        </div>
    @else
        <div>
            <div class="header-text card-header text-center fs-4">
                <div class="text-center fs-4 my-auto">
                    @lang('dashboard.view.finishedTask.header2')
                </div>
            </div>
            <div class="card-body">
                <div class="row align-items-center ms-2 me-2 mt-2">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-4 col-6 fs-4">
                        <div class="text-white-50">@lang('dashboard.view.finishedTask.playername'):</div>
                    </div>
                    <div class="col-xxl-4 col-6 fs-4 text-info text-center">
                        {{$selectedUserName}}
                    </div>
                </div>

                <div class="row align-items-center ms-2 me-2 mt-2">
                    <div class="col-xxl-2"></div>
                    <div class="col-xxl-4 col-6 fs-4">
                        <div class="text-white-50">@lang('dashboard.view.finishedTask.totalAmount'):</div>
                    </div>
                    <div class="col-xxl-4 col-6">
                        <div class="ms-2 fs-4 text-center">
                            <span class="text-danger">{{number_format(round($selectedUserTotalAmount), 0, ',', '.') }}</span> <span class="text-white-50">aUEC</span>
                        </div>
                    </div>
                </div>

                <hr>
                <div class="row align-items-center ms-2 me-2 mt-2">
                    <div class="col-xxl-2"></div>
                    <div class="col-xxl-4 col-6 fs-4">
                        <div class="text-white-50">@lang('dashboard.view.finishedTask.partialFigures'):</div>
                    </div>
                    <div class="col-xxl-4 col-6">
                        <div class="ms-2">
                            <select class="form-select text-center" wire:model="selectedAmountID">
                                <option value="-1" hidden selected>
                                    @lang('dashboard.view.finishedTask.pleaseSelect')</option>
                                @foreach($selectedUserPartAmountArray as $id => $amount)
                                    <option value="{{$id}}">
                                        {{ number_format(round($amount), 0, ',', '.')}} aUEC
                                    </option>
                                @endforeach
                            </select>
                            @error('selectedAmountID')<span class="fst-italic text-danger" role="alert">
                                {{ $message }}
                            </span> @enderror
                        </div>
                    </div>
                    <div class="col-lg-1 col-6">
                        <button type="submit" class="btn btn-outline-warning message"  wire:click.prevent="selectedAmountPay()">@lang('dashboard.view.finishedTask.partialPayment')</button>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-xxl-2"></div>
                    <div class="col-xxl-4 text-center">
                        <button type="button" class="btn btn-outline-success message btn-lg" wire:click.prevent="fullpayUser()">@lang('dashboard.view.finishedTask.totalPayment')</button>
                    </div>
                    <div class="col-xxl-4 text-center">
                        <button type="button" class="btn btn-outline-danger btn-lg w-75" wire:click.prevent="resetUserPayMode()">@lang('dashboard.view.finishedTask.cancel')</button>
                    </div>
                    <div class="col-xxl-2"></div>
                </div>
            </div>
        </div>
    @endif
</div>
