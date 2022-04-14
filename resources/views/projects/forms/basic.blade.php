<div class="row">
    <div class="col-md-6 offset-md-3">
        <h6>Basic Info</h6>
        <hr>
    </div>
</div>

<x-input-field name="name" description="The project directory name." :value="$project->name ?? null"/>
<x-input-field name="description" :value="$project->description ?? null"/>

<div class="row align-items-center mb-3">
    <div class="col-md-9 text-end">
        <button class="btn btn-lg btn-success">
            Save
        </button>
    </div>
</div>
