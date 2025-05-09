<table id="exampleFooEditing" class="table table-responsive table-bordered table-hover toggle-circle"
       data-paging="true" data-filtering="true" data-sorting="true">
    <thead style="background: #f1f4f5">
    <tr>
        <th style="width: 5%" class="text-center">No</th>
        <th style="width: 5%" class="text-center d-none">User Id</th>
        <th style="width: 15%" class="text-center d-none">Session Id</th>
        <th style="width: 10%" class="text-center">Name</th>
        <th style="width: 10%" class="text-center">Email</th>
        <th style="text-align: center; width: 20%">Ip Address</th>
        <th style="text-align: center; width: 50%">User Agent</th>
        <th style="text-align: center; width: 15%">Url</th>
        <th style="text-align: center; width: 5%">Action</th>
        <th style="width: 5%" class="text-center">Method</th>
        <th style="text-align: center; width: 10%">Affected Ids</th>
        <th class="d-none" style="text-align: center; width: 25%">Data</th>
        <th style="width:6%">Created At</th>
    </tr>
    </thead>
    <tbody>
    @foreach($activityLogs as $key=>$activity)
        <tr>
            <td class="text-center">{{ $rank++ }}</td>
            <td class="text-center d-none">{{ $activity['user_id'] }}</td>
            <td class="text-center d-none">{{ $activity['session_id'] }}</td>
            <td class="text-center">{{ $activity->user->name ?? '' }}</td>
            <td class="text-center">{{ $activity->user->email ?? '' }}</td>
            <td class="text-center">{{ $activity['ip_address'] }}</td>
            <td class="text-center">{{ $activity['user_agent'] }}</td>
            <td class="text-center">{{ $activity['url'] }}</td>
            <td class="text-center">{{ $activity['action'] }}</td>
            <td class="text-center">{{ $activity['method'] }}</td>
            <td class="text-center">{{ $activity['affected_ids'] }}</td>
            <td class="text-center d-none">{{ isset($activity['data']) ? json_encode($activity['data'],TRUE) : '' }}</td>
            <td class="text-center">{{ $activity['created_at'] }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

<div id="pagination-wrapper" class="pagination-sm float-right mt-15">
    {!! $activityLogs->links() !!}
</div>
