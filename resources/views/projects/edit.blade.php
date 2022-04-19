@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-content">
                <div class="card-header d-flex justify-content-between">
                    <h4>
                        Edit Project
                    </h4>
                    <div class="actions">
                        <a href="{{ route('projects.index') }}" class="btn btn-primary">
                            List Projects
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <livewire:projects.edit-page :project="$project">                
                </div>
            </div>
        </div>
    </div>
@endsection
