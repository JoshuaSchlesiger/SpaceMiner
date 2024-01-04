<div>
    <div class="row ms-3 mb-3 mt-3">
        <div class="col-md-6 col-6">
            <label for="visibility" class="fs-4">@lang('userSettings.view.visibilityExternalTasks'):</label>
        </div>
        <div class="col-md-6 col-6">
            <div class="form-check form-switch ms-2">
                <input class="form-check-input switch2" type="checkbox" role="switch" id="visibility"
                    wire:change="visibilityChange" @if ($visibility) checked @endif>
            </div>
        </div>
    </div>

    <div class="row ms-3 mb-3 mt-3">
        <div class="col-md-6 col-6">
            <label for="whitelistedPlayerInput" class="fs-4">@lang('userSettings.view.whitelistedPlayer'):</label>
        </div>
        <div class="col-md-3 col-3">
            <div class="form-outline">
                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror"
                    placeholder="" wire:model="username">
            </div>
            @error('username')
                @if ($message !== 'null')
                    <span class="fst-italic text-danger" role="alert">
                        {{ $message }}
                    </span>
                @endif
            @enderror
        </div>
        <div class="col-md-3 col-3">
            <button type="button" class="btn btn-outline-success" id="btnAddPlayer" wire:click='addPlayer'>ADD</button>
        </div>
    </div>

    <div class="row ms-3 mb-3 mt-3">
        <div class="col-md-3 offset-xxl-6 col-xxl-4">
            <table class="table table-dark table-striped text-center">
                <thead>
                    <tr class="fs-5">
                        <th scope="col" class="text-white-50">@lang('userSettings.view.name')</th>
                        <th scope="col" class="text-white-50"></th>
                    </tr>
                </thead>
                <tbody>
                    @isset($whitelist)
                        @if ($whitelist !== null)
                            @foreach ($whitelist["username"] as $index => $player)
                                <tr>
                                    <th scope="row" class="w-75">
                                        <div class="d-flex justify-content-center">
                                            <span class="fs-4 text-break">{{$player}}</span>
                                        </div>
                                    </th>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <button type="button" class="btn btn-outline-danger deletePart2" wire:click="deletePlayer({{ $index }})">X</button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    @endisset

                </tbody>
            </table>
        </div>
    </div>



</div>
