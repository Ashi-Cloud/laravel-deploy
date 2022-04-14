<div class="row">
    <div class="col-md-6 offset-md-3">
        <h6>Basic Info</h6>
        <hr>
    </div>
</div>
<div class="row align-items-center mb-3">
    <div class="col-md-3 text-md-end">
        <label for="">Name</label>
    </div>

    <div class="col-md-6">
        <input type="text" name="name" id="name" value="{{ old('name', $project->name ?? null) }}" class="form-control">
        @error('name')
            <div class="text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>

<div class="row align-items-center mb-3">
    <div class="col-md-9 text-end">
        <button class="btn btn-lg btn-success">
            Save
        </button>
    </div>
</div>
