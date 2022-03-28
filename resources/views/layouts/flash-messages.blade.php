@foreach (['alert-success', 'alert-danger', 'alert-info', 'alert-warning'] as $alert)
    @if (session()->has($alert))
        <div class="container">
            <div class="alert {{$alert}}">
                {{ session()->get($alert) }}
            </div>
        </div>
    @endif
@endforeach
