<x-form method="POST" wire:submit.prevent="save">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h6>{{ $heading ?? '' }}</h6>
            <hr>
        </div>
    </div>

    @yield('form_fields')

    <x-save-button />   
</x-form>