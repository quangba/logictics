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

            @if(Gate::check(MANAGE_CARRIER) || Gate::check(VIEW_ADD_CARRIER))
                <div class="page-header-actions">
                    <a class="btn btn-sm btn-primary btn-round" href="{{ route('carrier.create') }}">
                        <i class="icon md-collection-plus" aria-hidden="true"></i>
                        <span class="hidden-sm-down">Create Freight</span>
                    </a>
                </div>
            @endif
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
                                    <button id="basic" class="ml-5 ml-sm-10 float-right btn btn-primary">
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
                        <button class="btn btn-danger mb-3 btn-round" id="deleteSelected"><i class="md-delete" aria-hidden="true"></i> <span class="hidden-sm-down ml-5">Delete</span></button>
                    </div>
                    @endif

                    <h3 class="text-center" style="clear:both;">Tìm Thấy {{ $count }} Kết Quả</h3>

                    <div id="carrier-table-wrapper">
                        @include('includes.carriers.table', ['carriers' => $carriers])
                    </div>
                </div>

            </div>
        </div>
    </div>
    <input id="check-form" type="hidden" value="@if (isset($values)) {{ 2 }} @endif">
    @include('includes.modals.confirm_delete', ['message' => 'Bạn có chắc muốn xoá các Freight đã chọn không?'])
@endsection()

@section('script')
    <script src="{{ asset('js/carrier-list.js') }}"></script>
    <script src="{{ asset('js/bulk-helper.js') }}"></script>
    <script>
        $(document).ready(function() {
            if ($('#check-form').val() == 2) {
                $('#basic-form').hide();
                $('#advanced-form').show();
            } else {
                $('#basic-form').show();
                $('#advanced-form').hide();
            }

            initBulkCheckbox('carrier-checkbox', 'checkAll', 'deleteSelected');
            handlePagination('carrier-table-wrapper', 'carrier-checkbox', 'checkAll');
            handleDeleteAction(
                'deleteSelected',
                'confirmDeleteModal',
                'confirmDeleteBtn',
                '{{ route("carrier.bulkDelete") }}',
                'carrier-table-wrapper',
                '{{ route("carrier.search") }}'
            );
        });
    </script>
@endsection
