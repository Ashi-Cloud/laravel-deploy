<div wire:poll.3s>
    <div class="row">
        <div class="col-md-12 text-end">
            @if(!$project->isDeployable())
                Required information missing in project.
            @elseif ($activeDeployment)
                <div class="row">
                    <div class="col-md-4">
                        <strong>Status:</strong> Active 
                    </div>
                    <div class="col-md-4">
                        <strong>Runtime: </strong> {{ $activeDeployment->runtime }}
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-success disabled" >
                            <i class="fa-solid fa-arrows-rotate fa-spin"></i> Deploying
                        </button>
                    </div>
                </div>
            @else
                <div class="position-relative">
                    <button class="btn btn-success" wire:click="deploy">
                        <i class="fa-solid fa-server"></i>
                        Deploy
                    </button>
                </div>
            @endif
        </div>
    </div>
</div>