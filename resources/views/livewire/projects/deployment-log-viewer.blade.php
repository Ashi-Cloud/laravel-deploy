<div class="logs-wrapper">
    @if ($deployment)
        <p class="text-white bg-dark font-size-small p-2 m-0 logs" style="font-size: 12px;" {{ $deployment->isActive() ? "wire:poll.3s" : "" }}>
            {!! $deployment->getFormattedLog() !!}
        </p>
    @endif
</div>