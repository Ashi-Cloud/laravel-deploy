@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-content">
                <div class="card-header d-flex justify-content-between">
                    <h4>
                        Add Project
                    </h4>
                    <div class="actions">
                        <a href="{{ route('projects.index') }}" class="btn btn-primary">
                            List Projects
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('projects.store') }}" method="POST">
                        @csrf
                        @include('projects.forms.basic')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
