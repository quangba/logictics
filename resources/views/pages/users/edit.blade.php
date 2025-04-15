@extends('layouts.app')

@section('content')
    <div class="page">
        <div class="page-header">
            <h1 class="page-title">{{ __('labels.edit_user_header') }}</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">{{ __('users.home') }}</a></li>
                <li class="breadcrumb-item"><a href="{{route('users.index')}}">{{ __('users.users') }}</a></li>
                <li class="breadcrumb-item active">{{ __('users.edit') }}</li>
            </ol>
        </div>

        <div class="page-content">
            <div class="panel">
                <div class="panel-body container-fluid">
                    <div class="row row-lg">
                        <div class="col-md-12 col-lg-6">
                            <div class="example-wrap">
                                <div class="example">
                                    <form method="post" action="{{ route('users.update', $user->id) }}">
                                        @method('PUT')
                                        @csrf
                                        <input type="hidden" value="{{ URL::previous() }}">
                                        <h5>Họ Tên <span class="text-danger">*</span></h5>
                                        <div class="form-group form-material">
                                            <input type="text" class="form-control" name="name" placeholder="Name"
                                                   autocomplete="off" value="{{ old('name', $user->name) }}" autofocus />
                                            @error('name')
                                            <div class="text-danger text_error_name">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <h5>Email <span class="text-danger">*</span></h5>
                                        <div class="form-group form-material">
                                            <input type="text" class="form-control" name="email" placeholder="Email Address"
                                                   autocomplete="off" value="{{ old('email', $user->email) }}" />
                                            @error('email')
                                            <div class="text-danger text_error_email">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <h5>Mật khẩu</h5>
                                        <div class="form-group form-material">
                                            <input type="password" class="form-control" name="password" placeholder="Password"
                                                   autocomplete="new-password" value="{{ old('password') }}" />
                                            @error('password')
                                            <div class="text-danger text_error_pass">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <h5 class="example-title">Phân Quyền</h5>
                                        <div class="form-group form-material">
                                            @foreach($permissions as $permission)
                                                <div class="checkbox-custom checkbox-default">
                                                    @if(old('permissions') == null && $errors->getBag('default')->all() != null)
                                                        <input
                                                            {{ old('permissions') && in_array($permission->id, old('permissions')) ? 'checked' : '' }}
                                                            type="checkbox" id="{{$permission->id}}" value="{{$permission->id}}" name="permissions[]"
                                                            autocomplete="off" />
                                                        <label for="{{$permission->id}}">{{ __('permissions.' . $permission->name)}}</label>
                                                    @else
                                                        <input
                                                            {{ old('permissions', $permissionsAssigned) && in_array($permission->id, old('permissions', $permissionsAssigned)) ? 'checked' : '' }}
                                                            type="checkbox"
                                                            id="permission-{{ $permission->id }}"
                                                            value="{{ $permission->id }}"
                                                            name="permissions[]"
                                                            autocomplete="off" />
                                                        <label for="permission-{{ $permission->id }}">{{ __('permissions.' . $permission->name)}}</label>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                        <h5 class="example-title">Trạng Thái</h5>
                                        <div class="form-group">
                                            <select class="form-control" name="active">
                                                <option value="{{ FLAG_TRUE }}" {{ old('active', $user->active) == FLAG_TRUE ? 'selected' : '' }}>Activate</option>
                                                <option value="{{ FLAG_FALSE }}" {{ old('active', $user->active) == FLAG_FALSE ? 'selected' : '' }}>Locked</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
