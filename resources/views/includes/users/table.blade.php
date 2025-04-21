<table id="exampleFooEditing" class="table table-responsive table-bordered table-hover toggle-circle"
       data-paging="true" data-filtering="true" data-sorting="true">
    <thead style="background: #f1f4f5">
    <tr>
        @can('manage_users')
            <th style="width: 5%" class="text-center"><input type="checkbox" style="cursor: pointer;" id="checkAll"></th>
        @endcan
        <th style="width: 5%" class="text-center">No</th>
        <th style="width: 25%" class="text-center">@lang('users.name')</th>
        <th style="width: 25%" class="text-center">@lang('users.email')</th>
        <th style="width: 25%" class="text-center">@lang('users.permission')</th>
        <th style="text-align: center; width: 25%">@lang('users.status')</th>
        @can('manage_users')
            <th style="text-align: center; width: 10%">@lang('users.action')</th>
        @endcan
    </tr>
    </thead>
    <tbody>
    @foreach($users as $key=>$user)
        <tr>
            @can('manage_users')
                <td class="text-center">
                    @if($user->id !== Auth::id())
                        <input type="checkbox" class="user-checkbox" style="cursor: pointer;" value="{{ $user->id }}">
                    @endif
                </td>
            @endcan
            <td class="text-center">{{ $rank++ }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>
                @foreach($user->permissions as $p_key=>$permission)
                    {{ __('permissions.' . $permission->name) }}{{(count($user->permissions) != $p_key + 1) ? ',' : '' }}
                @endforeach
            </td>
            <td style="text-align: center;">
                {!! ($user->active != FLAG_TRUE) ? '<span class="badge badge-table badge-danger">Lock</span>' : '<span class="badge badge-table badge-success">Active</span>' !!}
            </td>
            @can('manage_users')
                <td style="text-align: center;">
                    <a class='btn btn-primary btn-sm waves-effect waves-classic'
                       href="{{ route('users.edit', $user->id) }}">
                        <i class="md-edit" aria-hidden="true"></i>
                        @lang('users.edit')
                    </a>
                </td>
            @endcan
        </tr>
    @endforeach
    </tbody>
</table>

<div id="pagination-wrapper" class="pagination-sm float-right mt-15">
    {!! $users->links() !!}
</div>
