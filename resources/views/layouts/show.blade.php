<table class="table">
    <thead>
    <tr>
        <th>Field</th>
        <th>Value</th>
    </tr>
    </thead>
    <tbody>
    @foreach($model->toArray() as $key => $row)
        @if(!is_array($row))
            <tr>
                <td>{{ $key }}</td>
                <td>{{ $row }}</td>
            </tr>
        @endif
    @endforeach
    </tbody>
</table>