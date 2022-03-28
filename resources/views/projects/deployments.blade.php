@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-content">
                <div class="card-header d-flex justify-content-between">
                    <h4>
                        Deployments
                    </h4>
                    <div class="actions">
                        <a href="{{ route('projects.index') }}" class="btn btn-primary">
                            List Project
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <livewire:projects.deploy-project-component :project="$project" />
                </div>
                <div class="card-footer">
                    <livewire:projects.deployment-table-component :project="$project" />
                </div>
            </div>
        </div>
    </div>
@endsection
