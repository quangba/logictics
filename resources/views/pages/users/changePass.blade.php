@extends('layouts.app')

@section('style')
    <style>
        .toggle-password {
            cursor: pointer;
        }
        .text_error_pass {
            padding-left: 1.0715rem;
        }
    </style>
@endsection
@section('content')
    <div class="page">
        <div class="page-header">
            <h1 class="page-title">Xin chào {{$user->name}}! Bạn muốn đổi mật khẩu <i class="icon md-alert-triangle" style="color: red" aria-hidden="true"></i></h1>
        </div>

        <div class="page-content container-fluid">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-8 col-md-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">@lang('passwords.change-pass')</h3>
                        </div>
                        <div class="panel-body container-fluid">
                            <form class="form-horizontal"  autocomplete="off" method="post"
                                  action="{{route('users.change.password') }}">
                            @method('patch')
                            @csrf

                                <div class="form-group row form-material">
                                    <label class="col-md-4 form-control-label pt-10">@lang('passwords.old_pass')  <span class="text-danger">*</span></label>
                                    <div class="col-md-8">
                                        <div class="col-md-11">
                                            <input type="password" id="password-field-1" class="form-control" name="old_password" autocomplete="old_password" value="{{ old('old_password') }}" autofocus/>
                                        </div>
                                        <div class="col-md-1 float-right">
                                            <span toggle="#password-field-1" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                        </div>

                                        @error('old_password')
                                        <div class="text-danger text_error_pass">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row form-material">
                                    <label class="col-md-4 form-control-label pt-10 mt-20">@lang('passwords.new_pass')  <span class="text-danger">*</span></label>
                                    <div class="col-md-8 mt-20">
                                        <div class="col-md-11">
                                            <input type="password" id="password-field-2" class="form-control" name="new_password" autocomplete="new_password" value="{{ old('new_password') }}" />
                                        </div>
                                        <div class="col-md-1 float-right">
                                            <span toggle="#password-field-2" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                        </div>
                                        @error('new_password')
                                        <div class="text-danger text_error_pass">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row form-material">
                                    <label class="col-md-4 form-control-label pt-10">@lang('passwords.confirm_pass')  <span class="text-danger">*</span></label>
                                    <div class="col-md-8">
                                        <div class="col-md-11">
                                            <input type="password" id="password-field-3" class="form-control" name="confirm_password" autocomplete="confirm_password" value="{{ old('confirm_password') }}"/>
                                        </div>
                                        <div class="col-md-1 float-right">
                                            <span toggle="#password-field-3" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                        </div>
                                        @error('confirm_password')
                                        <div class="text-danger text_error_pass">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary"
                                            id="validateButton2">@lang('passwords.submit')</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
