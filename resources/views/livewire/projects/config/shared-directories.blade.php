<x-form wire:submit.prevent="save">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h6>Shared files and directories</h6>
            <hr>
        </div>
    </div>

    <x-input-field name="shared_files" type="textarea" rows="10" wire:model.defer="shared_files"/>
    <x-input-field name="shared_directories" type="textarea" rows="10" wire:model.defer="shared_directories"/>

    <x-save-button />   
</x-form>