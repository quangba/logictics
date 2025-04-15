@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('theme/global/vendor/bootstrap-select/bootstrap-select.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/global/vendor/bootstrap-tokenfield/bootstrap-tokenfield.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/global/vendor/bootstrap-datepicker/bootstrap-datepicker.css') }}">
@endsection

@section('content')
    <div class="page">
        <div class="page-header">
            <h1 class="page-title">Chi tiết Freight</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">{{ __('users.home') }}</a></li>
                <li class="breadcrumb-item"><a href="{{route('carrier.index')}}">Freight</a></li>
                <li class="breadcrumb-item active">Chi tiết Freight</li>
            </ol>
        </div>

        <div class="page-content">
            <div class="panel">
                <div class="panel-body container-fluid">
                    <div class="row row-lg">
                        <div class="col-md-6 col-lg-6">
                                <h5>Carrier:</h5>
                                <div class="form-group form-material">
                                    <input type="text" class="form-control" name="carrier" placeholder="Carrier"
                                           autocomplete="off" value="{{ old('carrier', $carrier->carrier) }}" readonly  />
                                </div>

                                <h5>Carrier PIC:</h5>
                                <div class="form-group form-material">
                                    <input type="text" class="form-control" name="pic" placeholder="Carrier PIC"
                                           autocomplete="off" value="{{ old('pic', $carrier->pic) }}" readonly />
                                </div>

                                <h5>POL:</h5>
                                <div class="form-group form-material">
                                    <input type="text" class="form-control" name="pol" placeholder="POL"
                                           autocomplete="off" value="{{ old('pol', $carrier->pol) }}" readonly />
                                </div>

                                <h5>POD:</h5>
                                <div class="form-group form-material">
                                    <input type="text" class="form-control" name="pod" placeholder="POD"
                                           autocomplete="off" value="{{ old('pod', $carrier->pod) }}" readonly />
                                </div>

                                <h5>Effective Date:</h5>
                                <div class="input-daterange form-group form-material" data-plugin="datepicker" data-target="1">
                                    <div class="input-group" style="width: 100%">
                                                <span class="input-group-addon">
                                                <i class="icon md-calendar" aria-hidden="true"></i>
                                                </span>
                                        <input type="text" class="form-control" name="effective"
                                               value="{{ old('effective', $carrier->effective_date) }}" readonly/>
                                    </div>
                                    @error('effective')
                                    <div class="text-danger text_error_name">{{ $message }}</div>
                                    @enderror
                                    <div class="row">

                                    </div>
                                </div>

                                <h5>Expired Date:</h5>
                                <div class="input-daterange form-group form-material" data-plugin="datepicker" data-target="1">
                                    <div class="input-group" style="width: 100%">
                                            <span class="input-group-addon">
                                            <i class="icon md-calendar" aria-hidden="true"></i>
                                            </span>
                                        <input type="text" class="form-control" name="expired"
                                               value="{{ old('expired', $carrier->expired_date)}}" readonly/>
                                    </div>
                                    @error('expired')
                                    <div class="text-danger text_error_name">{{ $message }}</div>
                                    @enderror
                                    <div class="row">

                                    </div>
                                </div>

                        </div>
                        <div class="col-md-6 col-lg-6">
                            <h5>Freight:</h5>
                            <div class="form-group form-material">
                                <input type="text" class="form-control" name="freight" placeholder="Freight"
                                       autocomplete="off" value="{{ old('freight', $carrier->freight) }}" readonly />
                            </div>

                            <h5>Freight Note:</h5>
                            <div class="form-group form-material">
                                <input type="text" class="form-control" name="note" placeholder="Freight Note"
                                       autocomplete="off" value="{{ old('note', $carrier->freight_note) }}" readonly />
                            </div>

                            <h5>Frequency:</h5>
                            <div class="form-group form-material">
                                <input type="text" class="form-control" name="frequency" placeholder="Frequency"
                                       autocomplete="off" value="{{ old('frequency', $carrier->frequency) }}" readonly />
                            </div>

                            <h5>Transit Time:</h5>
                            <div class="form-group form-material">
                                <input type="text" class="form-control" name="transit" placeholder="Transit Time"
                                       autocomplete="off" value="{{ old('transit', $carrier->transit_time) }}" readonly />
                            </div>

                            <h5>Remarks:</h5>
                            <div class="form-group form-material">
                                <input type="text" class="form-control" name="remarks" placeholder="Remarks"
                                       autocomplete="off" value="{{ old('remarks', $carrier->remarks) }}" readonly />
                            </div>
                        </div>

                    </div>
                    <div class="form-group text-right">
                        <a href="{{route('carrier.index')}}" class="btn btn-primary" >Trở về</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection()

@section('script')
    <script src="{{ asset('theme/global/vendor/bootstrap-select/bootstrap-select.js') }}"></script>
    <script src="{{ asset('theme/global/vendor/bootstrap-tokenfield/bootstrap-tokenfield.js') }}"></script>
    <script src="{{ asset('theme/global/js/advanced.js') }}"></script>
@endsection

