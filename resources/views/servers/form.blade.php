<div class="row align-items-center mb-3">
    <div class="col-md-3 text-md-end">
        <label for="">Server Name</label>
    </div>

    <div class="col-md-6">
        <input type="text" name="name" id="name" value="{{ old('name', $server->name) }}" class="form-control">
        @error('name')
            <div class="text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>

<div class="row align-items-center mb-3">
    <div class="col-md-3 text-md-end">
        <label for="">SSH Host</label>
    </div>

    <div class="col-md-6">
        <input type="text" name="host" id="host" value="{{ old('host', $server->host) }}" class="form-control">
        @error('host')
            <div class="text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>

<div class="row align-items-center mb-3">
    <div class="col-md-3 text-md-end">
        <label for="">SSH User</label>
    </div>

    <div class="col-md-6">
        <input type="text" name="user" id="user" value="{{ old('user', $server->user) }}" class="form-control">
        @error('user')
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
            <option value="private_key" {{ old('authentication_type', $server->authentication_type) == 'private_key' ? 'selected' : '' }}>Private Key</option>
            <option value="password" {{ old('authentication_type', $server->authentication_type) == 'password' ? 'selected' : '' }}>Password</option>
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
        <input type="text" name="password" id="password" value="{{ old('password', $server->password) }}" class="form-control">
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
        <textarea type="text" name="private_key" id="private_key" rows="15" class="form-control">{{ old('private_key', $server->private_key) }}</textarea>
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
