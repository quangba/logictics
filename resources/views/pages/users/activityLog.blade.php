@extends('layouts.app')
@section('content')
    <div class="page" style="height: 100vh;">
        <div class="page-header">
            <h1 class="page-title">Danh sách Activity Log</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">{{ __('users.home') }}</a></li>
                <li class="breadcrumb-item"><a href="{{route('users.activity_log')}}">Activity Logs</a></li>
                <li class="breadcrumb-item active">{{ __('users.list') }}</li>
            </ol>
        </div>

        <div class="page-content">
            <div class="panel">
                @alert()
                @endalert
                <div class="panel-body">
                    <div id="user-table-wrapper">
                        @include('includes.activityLogs.table', ['activityLogs' => $activityLogs])
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                '{{ route("users.activity_log") }}'
            );
        });
    </script>
@endsection
