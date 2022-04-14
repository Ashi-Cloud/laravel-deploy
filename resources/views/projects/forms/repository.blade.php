<x-form :action="route('projects.update.repository', $project)" method="PUT">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h6>Repository Info</h6>
            <hr>
        </div>
    </div>

    <x-input-field name="git_repository" title="Repository" :value="$project->git_repository ?? null"/>
    <x-input-field name="git_branch" title="branch" :value="$project->git_branch ?? null"/>

    <div class="row align-items-center mb-3">
        <div class="col-md-9 text-end">
            <button class="btn btn-lg btn-success">
                Save
            </button>
        </div>
    </div>
</x-form>