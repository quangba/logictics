@extends('layouts.app')
@section('content')
    <div class="page" style="height: 100vh;">
        <div class="page-header">
            <h1 class="page-title">Danh sách</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">{{ __('users.home') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('carrier.index') }}">Freight</a></li>
                <li class="breadcrumb-item active">Danh sách Freight</li>
            </ol>

            @can(MANAGE_CARRIER)
                <div class="page-header-actions">
                    <a class="btn btn-sm btn-primary btn-round" href="{{ route('carrier.create') }}">
                        <i class="icon md-collection-plus" aria-hidden="true"></i>
                        <span class="hidden-sm-down">Create Freight</span>
                    </a>
                </div>
            @endcan
        </div>
        <div class="page-content">
            <div class="panel">
                @alert()
                @endalert
                <div class="panel-body">
                    @if (Auth::user()->id == SUPER_ADMIN_ID)
                        <a class="btn btn-sm btn-danger btn-round mt--30 mb-5" href="{{ route('carrier.export') }}">
                            <i class="icon md-download" aria-hidden="true"></i>
                            <span class="hidden-sm-down">Export Excel</span>
                        </a>
                    @endif
                    <div id="basic-form" class="float-right pb-20">
                        <form method="get" action="{{ route('carrier.search') }}">
                            @csrf
                            <div class="input-group">
                                <input type="text" name="keywords" class="form-control"
                                    value="@if (isset($keywords)) {{ $keywords }} @endif"
                                    placeholder="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                    <button id="basic" class="ml-10 float-right btn btn-primary">
                                        <i class="fa fa-exchange"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div id="advanced-form" style="width: 250px; border: silver solid 1px; border-radius: 5px"
                        class="form-group float-right p-10">
                        <form method="get" action="{{ route('carrier.search') }}">
                            @csrf
                            <div class="d-flex">
                                <div>
                                    <h5>Carrier:</h5>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="carrier" placeholder="Carrier"
                                            autocomplete="off"
                                            value="@if (isset($values)) {{ $values['carrier'] }} @endif" />
                                    </div>
                                </div>
                                <div class="ml-10">
                                    <h5>POL:</h5>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="pol" placeholder="POL"
                                            autocomplete="off"
                                            value="@if (isset($values)) {{ $values['pol'] }} @endif" />
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div>
                                    <h5>POD:</h5>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="pod" placeholder="POD"
                                            autocomplete="off"
                                            value="@if (isset($values)) {{ $values['pod'] }} @endif" />
                                    </div>
                                </div>
                                <div class="ml-10">
                                    <h5>Freight:</h5>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="freight" placeholder="Freight"
                                            autocomplete="off"
                                            value="@if (isset($values)) {{ $values['freight'] }} @endif" />
                                    </div>
                                </div>
                            </div>

                            <div class="float-right">
                                <button class="btn btn-primary" type="submit">
                                    Search
                                </button>
                                <button id="advanced" class="ml-10 float-right btn btn-primary">
                                    <i class="fa fa-exchange"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                    @if (Auth::user()->id == SUPER_ADMIN_ID)
                    <div class="d-flex">
                        <button class="btn btn-danger mb-3 btn-round" id="deleteSelected"><i class="md-delete" aria-hidden="true"></i> Delete</button>
                    </div>
                    @endif

                    <h3 class="text-center" style="clear:both;">Tìm Thấy {{ $count }} Kết Quả</h3>

                    <div id="carrier-table-wrapper">
                        @include('includes.carriers.table', ['carriers' => $carriers])
                    </div>
{{--                    <table id="exampleFooEditing" class="table table-responsive table-bordered table-hover toggle-circle"--}}
{{--                        data-paging="true" data-filtering="true" data-sorting="true">--}}
{{--                        <thead style="background: whitesmoke">--}}
{{--                            <tr class="text-center">--}}
{{--                                <th style="width:10%">Carrier</th>--}}
{{--                                <th style="width:10%">PIC</th>--}}
{{--                                <th style="width:10%">POL</th>--}}
{{--                                <th style="width:10%">POD</th>--}}
{{--                                <th style="width:6%">Effective Date</th>--}}
{{--                                <th style="width:6%">Expired Date</th>--}}
{{--                                <th style="width:10%">Freight</th>--}}
{{--                                <th style="width:10%">Freight Note</th>--}}
{{--                                <th style="width:10%">Frequency</th>--}}
{{--                                <th style="width:10%">Transit Time</th>--}}
{{--                                <th style="width:10%">Remarks</th>--}}
{{--                                <th style="width:10%">Input User</th>--}}
{{--                                <th style="width:6%">Created At</th>--}}
{{--                                <th style="width:10%">Editor</th>--}}
{{--                                <th style="width:6%">Updated At</th>--}}
{{--                                @can(MANAGE_CARRIER)--}}
{{--                                    <th style="width:10%">Action</th>--}}
{{--                                @endcan--}}
{{--                            </tr>--}}
{{--                        </thead>--}}
{{--                        <tbody>--}}
{{--                            @foreach ($carriers as $key => $carrier)--}}
{{--                                <tr href="{{ route('carrier.show', $carrier->id) }}"--}}
{{--                                    bgcolor="{{ strtotime(date('Y-m-d')) > strtotime($carrier->expired_date) ? '#FF0000' : '' }}"--}}
{{--                                    style="cursor: pointer;" class="text-center">--}}
{{--                                    <td class="page-break">{{ $carrier->carrier }}</td>--}}
{{--                                    <td class="page-break">{{ $carrier->pic }}</td>--}}
{{--                                    <td class="page-break">{{ $carrier->pol }}</td>--}}
{{--                                    <td class="page-break">{{ $carrier->pod }}</td>--}}
{{--                                    <td class="page-break">{{ $carrier->effective_date }}</td>--}}
{{--                                    <td class="page-break">{{ $carrier->expired_date }}</td>--}}
{{--                                    <td class="page-break">{{ $carrier->freight }}</td>--}}
{{--                                    <td class="page-break">{{ $carrier->freight_note }}</td>--}}
{{--                                    <td class="page-break">{{ $carrier->frequency }}</td>--}}
{{--                                    <td class="page-break">{{ $carrier->transit_time }}</td>--}}
{{--                                    <td class="page-break">{{ $carrier->remarks }}</td>--}}
{{--                                    <td class="page-break">{{ $carrier->input_user }}</td>--}}
{{--                                    <td class="page-break">{{ $carrier->created_at }}</td>--}}
{{--                                    <td class="page-break">{{ $carrier->editor }}</td>--}}
{{--                                    <td class="page-break">{{ $carrier->updated_at }}</td>--}}
{{--                                    @can(MANAGE_CARRIER)--}}
{{--                                        <td class="w-150 text-center">--}}
{{--                                            <a class='btn btn-primary btn-sm waves-effect waves-classic'--}}
{{--                                                href="{{ route('carrier.edit', $carrier->id) }}">--}}
{{--                                                <i class="md-edit" aria-hidden="true"></i>--}}
{{--                                                Edit--}}
{{--                                            </a>--}}
{{--                                        </td>--}}
{{--                                    @endcan--}}
{{--                                </tr>--}}
{{--                            @endforeach--}}
{{--                        </tbody>--}}
{{--                    </table>--}}
{{--                    <div class="pagination-sm float-right mt-15">--}}
{{--                        {{ $carriers->appends(request()->query()) }}--}}
{{--                    </div>--}}
                </div>

            </div>
        </div>
    </div>
    <input id="check-form" type="hidden" value="@if (isset($values)) {{ 2 }} @endif">
    @include('includes.modals.confirm_delete', ['message' => 'Bạn có chắc muốn xoá các Freight đã chọn không?'])
@endsection()

@section('script')
{{--    <script>--}}
{{--        let selectedCarriers = [];--}}

{{--        $(document).on('change', '.carrier-checkbox', function () {--}}
{{--            const id = $(this).val();--}}

{{--            if ($(this).is(':checked')) {--}}
{{--                if (!selectedCarriers.includes(id)) selectedCarriers.push(id);--}}
{{--            } else {--}}
{{--                selectedCarriers = selectedCarriers.filter(cid => cid !== id);--}}
{{--            }--}}

{{--            const total = $('.carrier-checkbox').length;--}}
{{--            const checked = $('.carrier-checkbox:checked').length;--}}
{{--            $('#checkAll').prop('checked', total > 0 && total === checked);--}}
{{--        });--}}

{{--        $(document).on('change', '#checkAll', function () {--}}
{{--            const isChecked = $(this).is(':checked');--}}
{{--            $('.carrier-checkbox').prop('checked', isChecked).trigger('change');--}}
{{--        });--}}

{{--        $(document).on('click', '.pagination a', function (e) {--}}
{{--            e.preventDefault();--}}
{{--            const url = $(this).attr('href');--}}

{{--            $.get(url, function (data) {--}}
{{--                $('#carrier-table-wrapper').html(data);--}}

{{--                $('.carrier-checkbox').each(function () {--}}
{{--                    const id = $(this).val();--}}
{{--                    if (selectedCarriers.includes(id)) {--}}
{{--                        $(this).prop('checked', true);--}}
{{--                    }--}}
{{--                });--}}

{{--                const total = $('.carrier-checkbox').length;--}}
{{--                const checked = $('.carrier-checkbox:checked').length;--}}
{{--                $('#checkAll').prop('checked', total > 0 && total === checked);--}}
{{--            });--}}
{{--        });--}}

{{--        $('#deleteSelected').on('click', function () {--}}
{{--            if (selectedCarriers.length === 0) {--}}
{{--                alert("Bạn chưa chọn Freight nào để xoá.");--}}
{{--                return;--}}
{{--            }--}}

{{--            if (!confirm("Bạn có chắc muốn xoá các Freight đã chọn không?")) return;--}}

{{--            $.ajax({--}}
{{--                url: '{{ route("carrier.bulkDelete") }}',--}}
{{--                method: 'POST',--}}
{{--                data: {--}}
{{--                    _token: '{{ csrf_token() }}',--}}
{{--                    ids: selectedCarriers--}}
{{--                },--}}
{{--                success: function (res) {--}}
{{--                    if (res.message) {--}}
{{--                        alert(res.message);--}}
{{--                    }--}}

{{--                    selectedCarriers = [];--}}

{{--                    setTimeout(() => {--}}
{{--                        location.reload();--}}
{{--                    }, 1000);--}}
{{--                },--}}
{{--                error: function (xhr) {--}}
{{--                    if (xhr.responseJSON && xhr.responseJSON.message) {--}}
{{--                        alert(xhr.responseJSON.message);--}}
{{--                    } else {--}}
{{--                        alert("Đã có lỗi xảy ra.");--}}
{{--                    }--}}
{{--                }--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}
<script>
    let selectedCarriers = [];

    // Checkbox từng dòng
    $(document).on('change', '.carrier-checkbox', function () {
        const id = $(this).val();
        if ($(this).is(':checked')) {
            if (!selectedCarriers.includes(id)) selectedCarriers.push(id);
        } else {
            selectedCarriers = selectedCarriers.filter(cid => cid !== id);
        }

        const total = $('.carrier-checkbox').length;
        const checked = $('.carrier-checkbox:checked').length;
        $('#checkAll').prop('checked', total > 0 && total === checked);
    });

    // Checkbox "Chọn tất cả"
    $(document).on('change', '#checkAll', function () {
        const isChecked = $(this).is(':checked');
        $('.carrier-checkbox').prop('checked', isChecked).trigger('change');
    });

    // Phân trang AJAX (giữ param search)
    $(document).on('click', '.pagination a', function (e) {
        e.preventDefault();
        const url = $(this).attr('href');

        $.get(url, function (data) {
            $('#carrier-table-wrapper').html(data);

            // Khôi phục checkbox đã chọn
            $('.carrier-checkbox').each(function () {
                const id = $(this).val();
                if (selectedCarriers.includes(id)) {
                    $(this).prop('checked', true);
                }
            });

            const total = $('.carrier-checkbox').length;
            const checked = $('.carrier-checkbox:checked').length;
            $('#checkAll').prop('checked', total > 0 && total === checked);
        });
    });

    // Mở modal xác nhận
    $('#deleteSelected').on('click', function () {
        if (selectedCarriers.length === 0) {
            showFlash("Bạn chưa chọn Freight nào để xoá.", 'warning');
            return;
        }

        $('#confirmDeleteModal').modal({
            backdrop: 'static',
            keyboard: false
        }).modal('show');
    });

    // Thao tác xoá khi xác nhận
    $('#confirmDeleteBtn').on('click', function () {
        const data = {
            _token: '{{ csrf_token() }}',
            ids: selectedCarriers
        };

        // Thêm toàn bộ param search hiện tại
        const params = new URLSearchParams(window.location.search);
        params.forEach((value, key) => {
            if (key !== 'page') data[key] = value;
        });

        $.ajax({
            url: '{{ route("carrier.bulkDelete") }}',
            method: 'POST',
            data: data,
            success: function (res) {
                $('#carrier-table-wrapper').html(res.html);
                showFlash(res.message ?? "Đã xoá thành công!", 'success');
                selectedCarriers = [];
                // KHÔNG cần pushState vì đang ở search → giữ nguyên URL hiện tại
            },
            error: function (xhr) {
                const msg = xhr.responseJSON?.message ?? 'Đã có lỗi xảy ra.';
                showFlash(msg, 'danger');
            }
        });

        $('#confirmDeleteModal').modal('hide');
    });

    // Trả lại focus sau khi đóng modal
    $('#confirmDeleteModal').on('hidden.bs.modal', function () {
        $('#deleteSelected').trigger('focus');
    });

    // Thông báo flash giống layout
    function showFlash(message, type = 'success') {
        $('.panel .alert').remove();

        const html = `
            <div class="alert dark alert-icon alert-${type} alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <i class="icon ${type === 'success' ? 'md-check' : 'md-close'}" aria-hidden="true"></i>
                <span style="padding-left: 10px">${message}</span>
            </div>`;

        $('.panel').prepend(html);
    }
</script>

    <script>
        $(document).ready(function() {
            $('#advanced-form').hide();

            if ($('#check-form').val() == 2) {
                $('#basic-form').hide();
                $('#advanced-form').show();
            } else {
                $('#basic-form').show();
                $('#advanced-form').hide();
            }

            $('#basic').click(function(e) {
                e.preventDefault();
                $('#basic-form').hide();
                $('#advanced-form').show();
            });

            $('#advanced').click(function(e) {
                e.preventDefault();
                $('#basic-form').show();
                $('#advanced-form').hide();
            });

            // $('table tr').click(function() {
            //     window.location = $(this).attr('href');
            //     return false;
            // });

            $(document).on('click', 'table td', function (e) {
                if ($(e.target).is('input[type=checkbox], .td-checkbox , .carrier-checkbox')) {
                    e.stopPropagation();
                    return;
                }

                const href = $(this).closest('tr').attr('href');
                if (href) {
                    window.location = href;
                }
            });
        });
    </script>
@endsection
