<table id="exampleFooEditing" class="table table-responsive table-bordered table-hover toggle-circle" data-paging="true"
    data-filtering="true" data-sorting="true">
    <thead style="background: whitesmoke">
        <tr class="text-center">
            @if (Auth::user()->id == SUPER_ADMIN_ID)
                <th style="width:5%"><input type="checkbox" style="cursor: pointer;" id="checkAll" /></th>
            @endif
            <th style="width:10%">Carrier</th>
            <th style="width:10%">PIC</th>
            <th style="width:10%">POL</th>
            <th style="width:10%">POD</th>
            <th style="width:6%">Effective Date</th>
            <th style="width:6%">Expired Date</th>
            <th style="width:10%">Freight</th>
            <th style="width:10%">Freight Note</th>
            <th style="width:10%">Frequency</th>
            <th style="width:10%">Transit Time</th>
            <th style="width:10%">Remarks</th>
            <th style="width:10%">Input User</th>
            <th style="width:6%">Created At</th>
            <th style="width:10%">Editor</th>
            <th style="width:6%">Updated At</th>
            @can(MANAGE_CARRIER)
                <th style="width:10%">Action</th>
            @endcan
        </tr>
    </thead>
    <tbody>
        @foreach ($carriers as $key => $carrier)
            <tr href="{{ route('carrier.show', $carrier->id) }}"
                bgcolor="{{ strtotime(date('Y-m-d')) > strtotime($carrier->expired_date) ? '#FF0000' : '' }}"
                class="text-center">
                @if (Auth::user()->id == SUPER_ADMIN_ID)
                    <td class="page-break td-checkbox text-center">
                        <input type="checkbox" class="carrier-checkbox" style="cursor: pointer;"
                            value="{{ $carrier->id }}">
                    </td>
                @endif
                <td class="page-break">{{ $carrier->carrier }}</td>
                <td class="page-break">{{ $carrier->pic }}</td>
                <td class="page-break">{{ $carrier->pol }}</td>
                <td class="page-break">{{ $carrier->pod }}</td>
                <td class="page-break">{{ $carrier->effective_date }}</td>
                <td class="page-break">{{ $carrier->expired_date }}</td>
                <td class="page-break">{{ $carrier->freight }}</td>
                <td class="page-break">{{ $carrier->freight_note }}</td>
                <td class="page-break">{{ $carrier->frequency }}</td>
                <td class="page-break">{{ $carrier->transit_time }}</td>
                <td class="page-break">{{ $carrier->remarks }}</td>
                <td class="page-break">{{ $carrier->input_user }}</td>
                <td class="page-break">{{ $carrier->created_at }}</td>
                <td class="page-break">{{ $carrier->editor }}</td>
                <td class="page-break">{{ $carrier->updated_at }}</td>
                @can(MANAGE_CARRIER)
                    <td class="w-150 text-center td-action">
                        <a class='btn btn-primary btn-sm waves-effect waves-classic'
                            href="{{ route('carrier.edit', $carrier->id) }}">
                            <i class="md-edit" aria-hidden="true"></i>
                            Edit
                        </a>
                    </td>
                @endcan
            </tr>
        @endforeach
    </tbody>
</table>

<div class="pagination-sm float-right mt-15">
    {!! $carriers->links() !!}
</div>
