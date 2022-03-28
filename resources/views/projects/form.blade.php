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

<div class="row">
    <div class="col-md-6 offset-md-3">
        <h6>SSH Host Info</h6>
        <hr>
    </div>
</div>

<div class="row align-items-center mb-3">
    <div class="col-md-3 text-md-end">
        <label for="">SSH Host</label>
    </div>

    <div class="col-md-6">
        <input type="text" name="host" id="host" value="{{ old('host', $project->host) }}" class="form-control">
        @error('host')
            <div class="text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>

<div class="row align-items-center mb-3">
    <div class="col-md-3 text-md-end">
        <label for="">User</label>
    </div>

    <div class="col-md-6">
        <input type="text" name="user" id="user" value="{{ old('user', $project->user) }}" class="form-control">
        @error('user')
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
    <div class="col-md-3 text-md-end">
        <label for="">Authentication Type</label>
    </div>

    <div class="col-md-6">
        <select name="authentication_type" id="authentication_type" class="form-control">
            <option value="private_key" {{ old('authentication_type', $project->authentication_type) == 'private_key' ? 'selected' : '' }}>Private Key</option>
            <option value="password" {{ old('authentication_type', $project->authentication_type) == 'password' ? 'selected' : '' }}>Password</option>
        </select>
        @error('authentication_type')
            <div class="text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>

<div class="row align-items-center mb-3" id="password_wrapper" style="display: none;">
    <div class="col-md-3 text-md-end">
        <label for="">Password</label>
    </div>

    <div class="col-md-6">
        <input type="text" name="password" id="password" value="{{ old('password', $project->password) }}" class="form-control">
        @error('password')
            <div class="text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>

<div class="row align-items-center mb-3" id="private_key_wrapper" style="display: none;">
    <div class="col-md-3 text-md-end">
        <label for="">Private Key</label>
    </div>

    <div class="col-md-6">
        <textarea type="text" name="private_key" id="private_key" rows="15" class="form-control">{{ old('private_key', $project->private_key) }}</textarea>
        @error('private_key')
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


@push('js')
    <script>
        $(document).ready(function(){
            $('#authentication_type').on('change',function(){
                if ( $(this).val() == 'password' ){
                    $('#password_wrapper').show();
                    $('#private_key_wrapper').hide();
                    return;
                }
    
                if ( $(this).val() != 'password' ){
                    $('#password_wrapper').hide();
                    $('#private_key_wrapper').show();
                    return;
                }
            })

            $('#authentication_type').trigger('change')

        });
    </script>
@endpush
