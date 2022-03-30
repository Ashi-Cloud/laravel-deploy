@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-content">
                <div class="card-header d-flex justify-content-between">
                    <h4>
                        Manage Servers
                    </h4>
                    <div class="actions">
                        <a href="{{ route('servers.create') }}" class="btn btn-primary">
                            Add Server
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-responsive">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Host</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($servers as $server)
                                <tr>
                                    <td>
                                        {{ $server->name }}
                                    </td>
                                    <td>
                                        {{ $server->host }}
                                    </td>
                                    <td>
                                        {{ $server->created_at->format('Y-m-d') }}
                                    </td>
                                    <td>
                                        <a href="{{ route('servers.show', $server) }}" class="btn btn-sm btn-info" title="Show Details">
                                            <i class="fa-solid fa-list"></i>
                                        </a>
                                        <a href="{{ route('servers.edit', $server) }}" class="btn btn-sm btn-success" title="Edit Project">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <form class="d-inline-block" action="{{ route('servers.destroy', $server) }}" method="POST">
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
