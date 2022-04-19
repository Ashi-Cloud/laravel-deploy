<x-form wire:submit.prevent="save">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h6>Server Info</h6>
            <hr>
        </div>
    </div>

    <x-input-field name="server_id" title="Server" type="select" :options="['items' => $servers]" wire:model.defer="server_id"/>
    <x-input-field name="server_path" wire:model.defer="server_path"/>

    <x-save-button />   
</x-form>