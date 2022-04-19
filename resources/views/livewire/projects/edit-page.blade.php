<div class="row">
    <div class="col-md-2">
        <ul class="nav nav-tabs flex-md-column" id="myTab" role="tablist">
            @foreach ($availableTabs as $tab_key => $name)
                <li class="nav-item" role="presentation">
                    @if ($tab != $tab_key)
                        <button class="btn w-100" type="button" id="{{$tab_key}}" wire:click.prevent="setTab('{{ $tab_key }}')">{{ $name }}</button>
                    @else
                        <button class="btn btn-primary w-100" type="button" id="{{$tab_key}}-prevented">{{ $name }}</button>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
    <div class="col-md-10">
        <div>
            <div id="{{ $tab }}-info" aria-labelledby="{{ $tab }}-info-tab">
                <livewire:is :component="$configComponentName" :key="$tab" :project="$project">
            </div>
        </div>
    </div>
</div>   