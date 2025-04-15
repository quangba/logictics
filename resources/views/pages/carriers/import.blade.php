@extends('layouts.app')
@section('content')
    <img src="{{asset('images/loading.gif')}}" style="display: none; width:60px; height: 60px; position: fixed; top: 50%; left: 50%"  id="load"  alt=""/>
    <div class="page" style="height: 100vh;">
        <div class="page-header">
            <h1 class="page-title">Import Freight</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">{{ __('users.home') }}</a></li>
                <li class="breadcrumb-item"><a href="{{route('carrier.index')}}">Freight</a></li>
                <li class="breadcrumb-item active">Import Freight</li>
            </ol>
        </div>
        <div class="page-content">
            <div class="panel">
                @alert()
                @endalert
                <div class="col-md-6 col-lg-6">
                    <div class="panel-body">
                        <!-- Example File Upload -->
                        <div class="example-wrap ">
                            <h4 class="example-title">File Upload<span class="text-danger"> *</span></h4>
                            <div class="form-group">
                                <form action="{{ route('carrier.storeImport') }}" method="POST" id="exampleStandardForm"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <div class="input-group input-group-file" data-plugin="inputGroupFile">
                                        <input type="text" class="form-control" readonly="">
                                        <span class="input-group-btn">
                                        <span class="btn btn-primary btn-file">
                                            <i class="icon md-upload" aria-hidden="true"></i>
                                            <input type="file" name="file" multiple="" accept=".xlsx, .xls, .csv">
                                        </span>
                                    </span>
                                    </div>
                                    @error('file')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <a href="{{route('carrier.index')}}" class="btn btn-info"
                                       id="">Trở về</a>
                                    <button type="submit" class="btn btn-primary my-2" id="validateButton2">Import</button>
                                </form>
                            </div>
                        </div>
                        <!-- End Example File Upload -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection()
@section('script')
    <script>
        $(document).ready(function () {
            $('#exampleStandardForm').submit(function () {
                $("#load").show();
                $('#validateButton2').prop('disabled', true);
                $('#validateButton2').css('cursor', 'not-allowed');
            });
        });
    </script>
    <script src="{{ asset('theme/global/js/Plugin/input-group-file.js') }}"></script>
@endsection
