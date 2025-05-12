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
                    <div id="advanced-form" style="width: 250px; border: silver solid 1px; border-radius: 5px"
                         class="form-group float-right p-10">
                        <form method="get" action="{{ route('users.activity_log') }}">
                            @csrf
                            <div class="d-flex">
                                <div>
                                    <h5>Name:</h5>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="name" placeholder="Name"
                                               autocomplete="off"
                                               value="@if (isset($values) && isset($values['name'])) {{ $values['name'] }} @endif" />
                                    </div>
                                </div>
                                <div class="ml-10">
                                    <h5>Email:</h5>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="email" placeholder="Email"
                                               autocomplete="off"
                                               value="@if (isset($values) && isset($values['email'])) {{ $values['email'] }} @endif" />
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div>
                                    <h5>URL:</h5>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="url" placeholder="URL"
                                               autocomplete="off"
                                               value="@if (isset($values) && isset($values['url'])) {{ $values['url'] }} @endif" />
                                    </div>
                                </div>
                            </div>

                            <div class="float-right">
                                <button class="btn btn-primary" type="submit">
                                    Search
                                </button>
                            </div>
                        </form>
                    </div>
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
