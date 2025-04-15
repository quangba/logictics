@extends('layouts.app')
@section('content')
<div class="page" style="height: 100vh;">
    <div class="page-header">
        <h1 class="page-title">@lang('users.userList')</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">{{ __('users.home') }}</a></li>
            <li class="breadcrumb-item"><a href="{{route('users.index')}}">{{ __('users.users') }}</a></li>
            <li class="breadcrumb-item active">{{ __('users.list') }}</li>
        </ol>

        @can('manage_users')
        <div class="page-header-actions">
            <a class="btn btn-sm btn-primary btn-round" href="{{route('users.create')}}">
                <i class="icon md-collection-plus" aria-hidden="true"></i>
                <span class="hidden-sm-down">@lang('users.createUser')</span>
            </a>
        </div>
        @endcan
    </div>

    <div class="page-content">
        <div class="panel">
            @alert()
            @endalert
            <div class="panel-body">
                <table id="exampleFooEditing" class="table table-responsive table-bordered table-hover toggle-circle"
                data-paging="true" data-filtering="true" data-sorting="true">
                    <thead style="background: #f1f4f5">
                        <tr>
                            <th style="width: 10%" class="text-center">No</th>
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
                <div class="pagination-sm float-right mt-15">
                    {{ $users->appends(request()->query()) }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection()
