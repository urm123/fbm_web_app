<table class="table table-responsive">
    <thead>
    <tr>
        @foreach($data['columns'] as $column)
            <th>
                {{$column['value']}}
            </th>
        @endforeach
    </tr>
    </thead>
    <tbody>
    @foreach($data['data'] as $datum)
        <tr>
            @foreach($data['columns'] as $column)
                <td>
                    {{ $datum->{$column['key']} }}
                </td>
            @endforeach
        </tr>
    @endforeach

    </tbody>

    @if(isset($data['total']))
        <tfoot>
        <tr>
            <td colspan="4">Total</td>
            <td>
                {{$data['total']}}
            </td>
        </tr>
        </tfoot>
    @endif
</table>