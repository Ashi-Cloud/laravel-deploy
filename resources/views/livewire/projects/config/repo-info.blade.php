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
        @if (!($git_remove_key || $git_generate_key))
            <x-input-field name="git_public_key" type="textarea" rows="14" title="Public Key" :value="$git_public_key" readonly />
        @endif

        <x-input-field name="git_remove_key" type="checkbox" title="Remove key" description="Remove key if repository is public." value="1" wire:model="git_remove_key"/>
    @endif

    <x-input-field name="git_generate_key" type="checkbox" title="Generate new key" value="1" wire:model="git_generate_key"/>

    <x-save-button />    
</x-form>