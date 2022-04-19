<x-form method="POST" wire:submit.prevent="save">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h6>Basic Info</h6>
            <hr>
        </div>
    </div>

    <x-input-field name="name" description="The project directory name." wire:model.defer="name"/>
    <x-input-field name="description" wire:model.defer="description"/>

    <x-save-button />   
</x-form>