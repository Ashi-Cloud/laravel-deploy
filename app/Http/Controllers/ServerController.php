<?php

namespace App\Http\Controllers;

use App\Http\Requests\Servers\ServerUpdateRequest;
use App\Models\Server;

class ServerController
{
    public function index()
    {
        $servers = Server::query()->paginate(50);
        return view('servers.index', compact('servers'));
    }

    public function create()
    {
        return view('servers.create', [
            'server' => new Server()
        ]);
    }

    public function store(ServerUpdateRequest $projectUpdateRequest)
    {
        Server::create(
            $projectUpdateRequest->validated()
        );

        session()->flash('alert-success','Server Created Succesfully');
        return to_route('servers.index');
    }

    public function edit(Server $server)
    {
        return view('servers.edit', compact('server'));
    }

    public function update(ServerUpdateRequest $projectUpdateRequest, Server $server)
    {
        $server->update(
            $projectUpdateRequest->validated()
        );

        session()->flash('alert-success','Server Updated Succesfully');
        return to_route('servers.index');
    }

    public function show(Server $server)
    {
        return view('servers.show', compact('server'));
    }

    public function destroy(Server $server)
    {
        $server->delete();
        session()->flash('alert-success','Server Deleted Succesfully');
        return to_route('servers.index');
    }
}
