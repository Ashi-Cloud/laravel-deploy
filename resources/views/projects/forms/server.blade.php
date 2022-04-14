<x-form :action="route('projects.update.server', $project)" method="PUT">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h6>Server Info</h6>
            <hr>
        </div>
    </div>

    <x-input-field name="server_id" title="Server" type="select" :options="['items' => $servers]" :value="$project->server_id ?? null"/>
    <x-input-field name="server_path" :value="$project->server_path ?? null"/>

    <div class="row align-items-center mb-3">
        <div class="col-md-9 text-end">
            <button class="btn btn-lg btn-success">
                Save
            </button>
        </div>
    </div>
</x-form>