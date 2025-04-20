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
                @can('manage_users')
                    <button class="btn btn-danger mb-2 btn-round" id="deleteSelected"><i class="md-delete" aria-hidden="true"></i> Xoá</button>
                @endcan
                <div id="user-table-wrapper">
                    @include('includes.users.table', ['users' => $users])
                </div>
            </div>
        </div>
    </div>
</div>
@include('includes.modals.confirm_delete', ['message' => 'Bạn có chắc muốn xoá các user đã chọn không?'])
@endsection()

@section('script')
    <script src="{{ asset('js/bulk-helper.js') }}"></script>
    <script>
        $(document).ready(function () {
            initBulkCheckbox('user-checkbox', 'checkAll', 'deleteSelected');
            handlePagination('user-table-wrapper', 'user-checkbox', 'checkAll');
            handleDeleteAction(
                'deleteSelected',
                'confirmDeleteModal',
                'confirmDeleteBtn',
                '{{ route("users.bulkDelete") }}',
                'user-table-wrapper',
                '{{ route("users.index") }}'
            );
        });
    </script>
@endsection
