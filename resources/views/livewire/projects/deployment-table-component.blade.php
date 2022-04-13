<div>
    <div class="actions d-flex justify-content-end">
        <button class="btn btn-success" id="refresh-button" title="Reload" wire:loading.class="d-none" wire:click="render">
            <i class="fa fa-arrows-rotate"></i>
        </button>
        <div class="btn btn-success" id="loading-indicator" wire:loading title="Reload">
            <i class="fa fa-arrows-rotate fa-spin"></i>
        </div>
    </div>
    <table class="table table-responsive table-hover">
        <thead>
            <tr>
                <th>Status</th>
                <th>Run Time</th>
                <th style="max-width: 400px;"></th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($deployments as $deployment)
                <tr wire:click="$emit('show-deploy-log','{{$deployment->id}}')" style="cursor: pointer">
                    <td>
                        {{ $deployment->status }}
                    </td>
                    <td>
                        {{ $deployment->runtime }}
                    </td>
                    <td class="w-75">
                        {{ $deployment->getShortLog() }}
                    </td>
                    <td>
                        {{ $deployment->created_at->format('Y-m-d') }}
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4">
                    <div class="d-flex justify-content-end">
                        {{ $deployments->links() }}
                    </div>
                </td>
            </tr>
        </tfoot>
    </table>
    
    @push('modals')
        <div class="modal" tabindex="-1" id="deployment-log-modal" role="dialog">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Deployment Logs</h5>
                        <button type="button" class="btn close bt-danger" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-0">
                        <livewire:projects.deployment-log-viewer />
                    </div>
                </div>
            </div>
        </div>
    @endpush
    
    @push('js')
        <script>
            Livewire.on('show-deploy-log',function(deploymentId){
                $('#deployment-log-modal .logs').remove();
                $('#deployment-log-modal .logs-wrapper').append('<div class="d-flex justify-content-center align-items-center p-5">Loading...</div>');

                Livewire.emit('showDeploymentLog',deploymentId)
                $('#deployment-log-modal').modal('show')
            })

        </script>
    @endpush    
</div>