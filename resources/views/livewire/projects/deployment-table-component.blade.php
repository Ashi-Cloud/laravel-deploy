<table class="table table-responsive">
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
            <tr>
                <td>
                    {{ $deployment->status }}
                </td>
                <td>
                    {{ $deployment->runtime }}
                </td>
                <td>
                    {{-- {{ $deployment->getShortLog() }} --}}
                    {!! $deployment->getFormattedLog() !!}
                </td>
                <td>
                    {{ $deployment->created_at->format('Y-m-d') }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>