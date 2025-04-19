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
                    <button class="btn btn-danger mb-2 btn-round" id="deleteSelected"><i class="md-delete" aria-hidden="true"></i> Delete</button>
                @endcan
                <div id="user-table-wrapper">
                    @include('includes.users.table', ['users' => $users])
                </div>
{{--                <table id="exampleFooEditing" class="table table-responsive table-bordered table-hover toggle-circle"--}}
{{--                data-paging="true" data-filtering="true" data-sorting="true">--}}
{{--                    <thead style="background: #f1f4f5">--}}
{{--                        <tr>--}}
{{--                            <th style="width: 10%" class="text-center">No</th>--}}
{{--                            <th style="width: 25%" class="text-center">@lang('users.name')</th>--}}
{{--                            <th style="width: 25%" class="text-center">@lang('users.email')</th>--}}
{{--                            <th style="width: 25%" class="text-center">@lang('users.permission')</th>--}}
{{--                            <th style="text-align: center; width: 25%">@lang('users.status')</th>--}}
{{--                            @can('manage_users')--}}
{{--                                <th style="text-align: center; width: 10%">@lang('users.action')</th>--}}
{{--                            @endcan--}}
{{--                        </tr>--}}
{{--                    </thead>--}}
{{--                    <tbody>--}}
{{--                        @foreach($users as $key=>$user)--}}
{{--                            <tr>--}}
{{--                                <td class="text-center">{{ $rank++ }}</td>--}}
{{--                                <td>{{ $user->name }}</td>--}}
{{--                                <td>{{ $user->email }}</td>--}}
{{--                                <td>--}}
{{--                                    @foreach($user->permissions as $p_key=>$permission)--}}
{{--                                        {{ __('permissions.' . $permission->name) }}{{(count($user->permissions) != $p_key + 1) ? ',' : '' }}--}}
{{--                                    @endforeach--}}
{{--                                </td>--}}
{{--                                <td style="text-align: center;">--}}
{{--                                    {!! ($user->active != FLAG_TRUE) ? '<span class="badge badge-table badge-danger">Lock</span>' : '<span class="badge badge-table badge-success">Active</span>' !!}--}}
{{--                                </td>--}}
{{--                                @can('manage_users')--}}
{{--                                    <td style="text-align: center;">--}}
{{--                                        <a class='btn btn-primary btn-sm waves-effect waves-classic'--}}
{{--                                            href="{{ route('users.edit', $user->id) }}">--}}
{{--                                            <i class="md-edit" aria-hidden="true"></i>--}}
{{--                                            @lang('users.edit')--}}
{{--                                        </a>--}}
{{--                                    </td>--}}
{{--                                @endcan--}}
{{--                            </tr>--}}
{{--                        @endforeach--}}
{{--                    </tbody>--}}
{{--                </table>--}}
{{--                <div class="pagination-sm float-right mt-15">--}}
{{--                    {{ $users->appends(request()->query()) }}--}}
{{--                </div>--}}
            </div>
        </div>
    </div>
</div>
@include('includes.modals.confirm_delete', ['message' => 'Bạn có chắc muốn xoá các user đã chọn không?'])
@endsection()

@section('script')
<script>
    let selectedUsers = [];

    $(document).on('change', '.user-checkbox', function () {
        const id = $(this).val();
        if ($(this).is(':checked')) {
            if (!selectedUsers.includes(id)) selectedUsers.push(id);
        } else {
            selectedUsers = selectedUsers.filter(uid => uid !== id);
        }

        const total = $('.user-checkbox').length;
        const checked = $('.user-checkbox:checked').length;
        $('#checkAll').prop('checked', total > 0 && total === checked);
    });

    $(document).on('change', '#checkAll', function () {
        const isChecked = $(this).is(':checked');
        $('.user-checkbox').prop('checked', isChecked).trigger('change');
    });

    $(document).on('click', '.pagination a', function (e) {
        e.preventDefault();
        const url = $(this).attr('href');
        $.get(url, function (data) {
            $('#user-table-wrapper').html(data);

            $('.user-checkbox').each(function () {
                const id = $(this).val();
                if (selectedUsers.includes(id)) {
                    $(this).prop('checked', true);
                }
            });

            const total = $('.user-checkbox').length;
            const checked = $('.user-checkbox:checked').length;
            $('#checkAll').prop('checked', total > 0 && total === checked);
        });
    });

    // Mở modal xác nhận
    $('#deleteSelected').on('click', function () {
        if (selectedUsers.length === 0) {
            showFlash("Chưa chọn user nào!", 'warning');
            return;
        }
        $('#confirmDeleteModal').modal({
            backdrop: 'static',
            keyboard: false
        });

        $('#confirmDeleteModal').modal('show');
    });

    // Xoá khi xác nhận trong modal
    $('#confirmDeleteBtn').on('click', function () {
        $.ajax({
            url: '{{ route("users.bulkDelete") }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                ids: selectedUsers
            },
            success: function (res) {
                $('#user-table-wrapper').html(res.html);
                showFlash(res.message ?? "Đã xoá thành công!", 'success');
                selectedUsers = [];
                window.history.pushState({}, '', '{{ route("users.index") }}');
            },
            error: function (xhr) {
                const msg = xhr.responseJSON?.message ?? 'Đã có lỗi xảy ra.';
                showFlash(msg, 'danger');
            }
        });

        $('#confirmDeleteModal').modal('hide');
    });

    $('#confirmDeleteModal').on('hidden.bs.modal', function () {
        // Trả lại focus cho nút xoá (hoặc bất kỳ chỗ nào an toàn)
        $('#deleteSelected').trigger('focus');
    });


    function showFlash(message, type = 'success') {
        // Xoá alert cũ trước khi thêm mới
        $('.panel .alert').remove();

        const html = `
        <div class="alert alert-${type} alert-dismissible fade show mt-3" role="alert">
            ${message}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>`;
        $('.panel').prepend(html);
    }
</script>

@endsection
