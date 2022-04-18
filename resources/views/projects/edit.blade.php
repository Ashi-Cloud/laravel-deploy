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
                                    <button class="btn w-100" id="server-tab" data-bs-toggle="tab"
                                        data-bs-target="#server" type="button" role="tab" aria-controls="server"
                                        aria-selected="false">Server Info</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="btn w-100" id="repository-tab" data-bs-toggle="tab"
                                        data-bs-target="#repository" type="button" role="tab" aria-controls="repository"
                                        aria-selected="false">Repository Info</button>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-10">
                            <div class="tab-content p-2" id="myTabContent">
                                <div class="tab-pane fade show active" id="basic-info" role="tabpanel" aria-labelledby="basic-info-tab">
                                    <livewire:projects.config.basic-info :project="$project"/>
                                </div>
                                <div class="tab-pane fade" id="repository" role="tabpanel" aria-labelledby="repository-tab">
                                    <livewire:projects.config.repo-info :project="$project"/>
                                </div>
                                <div class="tab-pane fade" id="server" role="tabpanel" aria-labelledby="server-tab">
                                    <livewire:projects.config.server-info :project="$project"/>
                                </div>
                            </div>
                        </div>
                    </div>                   
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        jQuery(document).ready(function ($) {
            let updateQueryParams = function(params, _url, return_url){
                try {
                    let url = _url || window.location.href
                    url = new URL(url);

                    params.forEach(function(param){
                        if(param.value){
                            url.searchParams.set(param.name, param.value);
                        }else{
                            url.searchParams.delete(param.name);
                        }
                    });

                    let newUrl = url.toString();

                    if(return_url){
                        return newUrl;
                    }

                    window.history.pushState({path: newUrl}, '', newUrl);
                } catch (e) {console.log(e)}

                if(return_url){
                    return _url;
                }
            }

            $('[data-bs-toggle="tab"]').on('show.bs.tab', function(e) {
                updateQueryParams([
                    {name: 'tab', value: $(this).data('bs-target').replace('#', '')}
                ])
            })

            let urlParams = new URLSearchParams(window.location.search);
            let tab = '#' + (urlParams.get('tab') || 'basic-info');

            $('[data-bs-toggle="tab"][data-bs-target="' + tab + '"]').tab('show')
        });    
    </script>    
@endpush
