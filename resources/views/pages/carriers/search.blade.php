@extends('layouts.app')
@section('content')
    <div class="page" style="height: 100vh;">
        <div class="page-header">
            <h1 class="page-title">Danh sách</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">{{ __('users.home') }}</a></li>
                <li class="breadcrumb-item"><a href="{{route('carrier.index')}}">Freight</a></li>
                <li class="breadcrumb-item active">Danh sách Freight</li>
            </ol>

            @can(MANAGE_CARRIER)
                <div class="page-header-actions">
                    <a class="btn btn-sm btn-primary btn-round" href="{{route('carrier.create')}}">
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
                    @if(Auth::user()->id == SUPER_ADMIN_ID)
                        <a class="btn btn-sm btn-danger btn-round mt--30 mb-5" href="{{route('carrier.export')}}">
                            <i class="icon md-download" aria-hidden="true"></i>
                            <span class="hidden-sm-down">Export Excel</span>
                        </a>
                    @endif
                    <div id="basic-form" class="float-right pb-20">
                        <form method="get" action="{{route('carrier.search')}}">
                            @csrf
                            <div class="input-group">
                                <input type="text" name="keywords" class="form-control" value="@if(isset($keywords)) {{$keywords}} @endif" placeholder="Search">
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

                    <div id="advanced-form" style="width: 250px; border: silver solid 1px; border-radius: 5px" class="form-group float-right p-10">
                        <form method="get" action="{{route('carrier.search')}}">
                            @csrf
                            <div class="d-flex">
                                <div>
                                    <h5>Carrier:</h5>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="carrier" placeholder="Carrier"
                                               autocomplete="off" value="@if(isset($values)){{$values['carrier']}}@endif"  />
                                    </div>
                                </div>
                                <div class="ml-10">
                                    <h5>POL:</h5>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="pol" placeholder="POL"
                                               autocomplete="off" value="@if(isset($values)){{$values['pol']}}@endif"  />
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div>
                                    <h5>POD:</h5>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="pod" placeholder="POD"
                                               autocomplete="off" value="@if(isset($values)){{$values['pod']}}@endif"  />
                                    </div>
                                </div>
                                <div class="ml-10">
                                    <h5>Freight:</h5>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="freight" placeholder="Freight"
                                               autocomplete="off" value="@if(isset($values)){{$values['freight']}}@endif"  />
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

                        <h3 class="text-center">Tìm Thấy {{$count}} Kết Quả</h3>
                    <table id="exampleFooEditing" class="table table-responsive table-bordered table-hover toggle-circle" data-paging="true"
                           data-filtering="true" data-sorting="true">
                        <thead style="background: whitesmoke">
                        <tr class="text-center">
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
                        @foreach($carriers as $key=>$carrier)
                            <tr href="{{route('carrier.show', $carrier->id)}}" bgcolor="{{strtotime(date("Y-m-d")) > strtotime($carrier->expired_date) ? '#FF0000' : ''}}" style="cursor: pointer;" class="text-center">
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
                                    <td class="w-150 text-center">
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
                        {{ $carriers->appends(request()->query()) }}
                    </div>
                </div>

            </div>
        </div>
    </div>
    <input id="check-form" type="hidden" value="@if(isset($values)){{2}}@endif">
@endsection()

@section('script')
    <script>
        $(document).ready(function() {
            $('#advanced-form').hide();

            if($('#check-form').val() == 2){
                $('#basic-form').hide();
                $('#advanced-form').show();
            }else{
                $('#basic-form').show();
                $('#advanced-form').hide();
            }

            $('#basic').click(function(e){
                e.preventDefault();
                $('#basic-form').hide();
                $('#advanced-form').show();
            });

            $('#advanced').click(function(e){
                e.preventDefault();
                $('#basic-form').show();
                $('#advanced-form').hide();
            });

            $('table tr').click(function(){
                window.location = $(this).attr('href');
                return false;
            });
        });
    </script>
@endsection
