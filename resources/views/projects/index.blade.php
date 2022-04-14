@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-content">
                <div class="card-header d-flex justify-content-between">
                    <h4>
                        Manage Projects
                    </h4>
                    <div class="actions">
                        <a href="{{ route('projects.create') }}" class="btn btn-primary">
                            Create Project
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-responsive">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Server</th>
                                <th>Type</th>
                                <th>Last Deployed</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($projects as $project)
                                <tr>
                                    <td>
                                        {{ $project->name }}
                                    </td>
                                    <td>
                                        {{ $project->server->name ?? 'N/A' }}
                                    </td>
                                    <td>
                                        {{ $project->type }}
                                    </td>
                                    <td>
                                        <i>{{ $project->last_deployed ?: 'Never' }}</i>
                                    </td>
                                    <td>
                                        {{ $project->created_at->format('Y-m-d') }}
                                    </td>
                                    <td>
                                        <a href="{{ route('projects.deployments', $project) }}" class="btn btn-sm btn-warning" title="Deployments">
                                            <i class="fa-solid fa-server"></i>
                                        </a>
                                        <a href="{{ route('projects.show', $project) }}" class="btn btn-sm btn-info" title="Show Details">
                                            <i class="fa-solid fa-list"></i>
                                        </a>
                                        <a href="{{ route('projects.edit', $project) }}" class="btn btn-sm btn-success" title="Edit Project">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <form class="d-inline-block" action="{{ route('projects.destroy', $project) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger" title="Delete Project">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
