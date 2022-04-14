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
                    <div class="row">
                        <div class="col-md-2">
                            <ul class="nav nav-tabs flex-md-column" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="btn active w-100" id="basic-info-tab" data-bs-toggle="tab"
                                        data-bs-target="#basic-info" type="button" role="tab" aria-controls="basic-info"
                                        aria-selected="true">Basic Info</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="btn w-100" id="profile-tab" data-bs-toggle="tab"
                                        data-bs-target="#profile" type="button" role="tab" aria-controls="profile"
                                        aria-selected="false">Repository Info</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="btn w-100" id="contact-tab" data-bs-toggle="tab"
                                        data-bs-target="#contact" type="button" role="tab" aria-controls="contact"
                                        aria-selected="false">Contact</button>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-10">
                            <div class="tab-content p-2" id="myTabContent">
                                <div class="tab-pane fade show active" id="basic-info" role="tabpanel" aria-labelledby="basic-info-tab">
                                    <form action="{{ route('projects.update', $project) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        @include('projects.form')
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">...
                                </div>
                                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...
                                </div>
                            </div>
                        </div>
                    </div>                   
                </div>
            </div>
        </div>
    </div>
@endsection
