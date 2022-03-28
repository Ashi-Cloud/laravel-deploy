@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-content">
                <div class="card-header d-flex justify-content-between">
                    <h4>
                        View Project
                    </h4>
                    <div class="actions">
                        <a href="{{ route('projects.index') }}" class="btn btn-primary">
                            List Projects
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @foreach (array_filter($project->toArray(),'strlen') as $key => $value)
                        <div class="row">
                            <div class="col-md-3 text-md-end">
                                <strong>{{ str($key)->replace('_',' ')->title() }} :</strong>
                            </div>
                            <div class="col-md-6">
                                {{ $value }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
