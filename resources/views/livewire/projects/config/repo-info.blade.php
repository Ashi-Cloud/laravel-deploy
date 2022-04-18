<x-form wire:submit.prevent="save">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h6>Repository Info</h6>
            <hr>
        </div>
    </div>

    <x-input-field name="git_repository" title="Repository" wire:model.defer="git_repository"/>
    <x-input-field name="git_branch" title="branch" wire:model.defer="git_branch"/>

    @if (!empty($git_public_key = $project->git_public_key ?? null))
        <x-input-field name="git_public_key" type="textarea" rows="14" title="Public Key" :value="$git_public_key" readonly />
    @endif

    <x-input-field name="git_generate_key" type="checkbox" title="Generate new key" value="1" wire:model.defer="git_generate_key"/>


    <div class="row align-items-center mb-3">
        <div class="col-md-9 text-end">
            <button class="btn btn-lg btn-success">
                Save
            </button>
        </div>
    </div>
</x-form>