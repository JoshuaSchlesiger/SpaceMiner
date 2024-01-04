<div>
    @if($show)
    <div id="modal" class="modal">
        <div class="modal-dialog modal-content">
                <div class="modal-header bg-opacity-75 w-100">
                    <div class="row w-100">
                        <div class="col-3"></div>
                        <div class="col-8">
                            <h1 class="modal-title fs-4">@lang('dashboard.view.modal.header')</h1>
                        </div>
                        <div class="col-1 my-auto">
                           <button type="button" class="btn-close modalClose" wire:click.prevent='closeModal()'></button>
                        </div>
                    </div>
                </div>


                <div class="modal-footer d-flex justify-content-evenly">
                    <div>
                        <button type="button" class="btn btn-lg btn-danger message modalClose message" wire:click.prevent='deleteTask()'>@lang('dashboard.view.modal.delete')</button>
                    </div>
                    <div>
                        <button type="button" class="btn btn-lg btn-secondary modalClose" wire:click.prevent='closeModal()'>@lang('dashboard.view.modal.cancel')</button>
                    </div>
                </div>
        </div>
    </div>

    @endif
</div>
