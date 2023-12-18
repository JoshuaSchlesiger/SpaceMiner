<div>
    @if ($changeMode)
        <div>
            <form wire:submit="sellTaskOres">
                @csrf
                <div class="header-text card-header text-center">

                    @if ($showCombineButton)
                        <div class="row">
                            <div class="col text-start">
                                <button type="button" id="deleteTask"
                                class="btn btn-outline-danger trash-button btn-sm"><i class="bi bi-trash h5"></i></button>
                            </div>
                            <div class="col fs-4 my-auto">
                                Verkaufen
                            </div>

                            <div class="col text-end">
                                <button type="button" class="btn btn-outline-warning"
                                    wire:click.prevent="sendTaskToCombine()">Kombinieren</button>
                            </div>
                        </div>
                    @else
                    <div class="row">
                        <div class="col text-start">
                            <button type="button"
                            class="btn btn-outline-danger trash-button btn-sm"><i class="bi bi-trash h5"></i></button>
                        </div>
                    
                        <div class="col text-center fs-4 my-auto">
                            Verkaufen
                        </div>

                        <div class="col">

                        </div>
                    </div>

                    @endif
                </div>
                <div class="card-body">
                    <div class="row align-items-center ms-2 me-2 mt-2" id="successMessage23">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-4 col-6 fs-4">
                            <div class="text-white-50">Erzmetall:</div>
                        </div>
                        <div class="col-lg-4 col-6">
                            <div class="ms-2">
                                <select class="form-select text-center" name="oreType" wire:model="selectedOre"
                                    wire:change="getSelectedOreUnits">
                                    @if (empty($selectedOre))
                                        <option value="" class="" hidden selected>
                                            Bitte wählen
                                        </option>
                                    @endif
                                    @foreach ($ores as $oreName => $ore)
                                        <option value="{{ $oreName }}">
                                            {{ $oreName }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('selectedOre')
                                    <span class="fst-italic text-danger" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row align-items-center ms-2 me-2 mt-2">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-4 col-6 fs-4">
                            <div class="text-white-50">Einheiten:</div>
                        </div>
                        <div class="col-lg-4 col-6">
                            <div class="ms-2 fs-4 text-center">
                                <span>{{ $selectedOreUnits }}</span> <span class="text-white-50">units</span>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row align-items-center ms-2 me-2 mt-2">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-4 col-6 fs-4">
                            <div class="text-white-50">Verkaufsstation:</div>
                        </div>
                        <div class="col-lg-4 col-6">
                            <div class="ms-2">
                                <select class="form-select text-center" wire:model="sellingStation">
                                    <option value="" class="" hidden selected>
                                        Bitte wählen
                                    </option>
                                    @foreach ($stations as $station)
                                        <option value="{{ $station['id'] }}">
                                            {{ $station['name'] }}
                                        </option>
                                    @endforeach

                                </select>
                                @error('sellingStation')
                                    <span class="fst-italic text-danger" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center ms-2 me-2 mt-2">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-4 col-6 fs-4">
                            <div class="text-white-50">Verkaufspreis:</div>
                        </div>
                        <div class="col-lg-4 col-6">
                            <div class="ms-2 ">
                                <input id="massStone" type="number" class="form-control text-center"
                                    placeholder="69420 aUEC" wire:model="sellingPrice" />
                                @error('sellingPrice')
                                    <span class="fst-italic text-danger" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-evenly mt-3">
                        <button type="submit" class="btn btn-outline-success btn-lg">Speichern</button>
                        <button type="button" class="btn btn-outline-danger btn-lg"
                            wire:click='hideInformationMode()'>Abbrechen</button>
                    </div>
                    @if ($successMessage)
                        <div class="alert alert-success mt-3 text-center" wire:poll="resetSuccessMessage">
                            {{ $successMessage }}
                        </div>
                    @endif
                </div>
            </form>
        </div>
    @else
        <div>
            <div class="header-text card-header text-center fs-4">
                Zu bezahlende Spieler
            </div>
            <div class="card-body payablePlayerList">
                @foreach ($payablePlayer as $username => $player)
                    <div class="row listItems align-items-center ms-2 me-2">
                        <div class="col row fs-5 d-flex justify-content-evenly">
                            <div class="col-6 text-white-50 text-center">Spielername:</div>
                            <div class="col text-info text-center">{{ $username }}</div>
                        </div>
                        <div class="col row fs-5 d-flex justify-content-evenly">
                            <div class="col-4 text-white-50 text-center">Betrag:</div>
                            <div class="col"><span
                                    class="text-danger">{{ number_format(round($playerValue[$username]), 0, ',', '.') }}</span><span>
                                    aUEC</span></div>
                        </div>
                    </div>
                    <hr>
                @endforeach
            </div>
        </div>
    @endif
  
</div>
