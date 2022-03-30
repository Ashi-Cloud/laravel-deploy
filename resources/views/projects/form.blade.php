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
        <input type="text" name="name" id="name" value="{{ old('name', $project->name) }}" class="form-control">
        @error('name')
            <div class="text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>


<div class="row">
    <div class="col-md-6 offset-md-3">
        <h6>Repository Info</h6>
        <hr>
    </div>
</div>
<div class="row align-items-center mb-3">
    <div class="col-md-3 text-md-end">
        <label for="">Git Repository</label>
    </div>

    <div class="col-md-6">
        <input type="text" name="git_repository" id="git_repository" value="{{ old('git_repository', $project->git_repository) }}" class="form-control">
        @error('git_repository')
            <div class="text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>
<div class="row align-items-center mb-3">
    <div class="col-md-3 text-md-end">
        <label for="">Git Branch</label>
    </div>

    <div class="col-md-6">
        <input type="text" name="git_branch" id="git_branch" value="{{ old('git_branch', $project->git_branch) }}" class="form-control">
        @error('git_branch')
            <div class="text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>

<div class="row align-items-center mb-3">
    <div class="col-md-3 text-md-end">
        <label for="">Server</label>
    </div>

    <div class="col-md-6">
        <select name="server" id="server" class="form-control">
            <option value="">Select Server</option>
            @foreach ($servers as $server)
                <option value="{{$server->id}}" {{ $server->id == $project->server_id ? 'selected' : '' }}>{{ $server->name }}</option>
            @endforeach
        </select>
        @error('server')
            <div class="text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>

<div class="row align-items-center mb-3">
    <div class="col-md-3 text-md-end">
        <label for="">Server Path</label>
    </div>

    <div class="col-md-6">
        <input type="text" name="server_path" id="server_path" value="{{ old('server_path', $project->server_path) }}" class="form-control">
        @error('server_path')
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
