<div wire:poll.3s>
    <div class="row">
        <div class="col-md-12 text-end">
            @if ($activeDeployment)
                <button class="btn btn-success disabled" >
                    <i class="fa-solid fa-arrows-rotate fa-spin"></i> Deploying
                </button>
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


@push('js')
    <script>
        $(document).ready(function(){
            Livewire.on('deploy', function(){
                alert('deploying')
            })
        })
    </script>
@endpush