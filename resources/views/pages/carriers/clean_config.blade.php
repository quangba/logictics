@extends('layouts.app')
@section('content')
    <div class="page" style="height: 100vh;">
        <div class="page-header">
            <h1 class="page-title">Thiết lập xoá dữ liệu định kỳ Freight</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">{{ __('users.home') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('carrier.clean_config') }}">Thiết lập </a></li>
                <li class="breadcrumb-item active">{{ __('users.list') }}</li>
            </ol>
        </div>

        <div class="page-content">
            <div class="panel">
                @alert()
                @endalert
                <div class="panel-body">
                    <div class="mb-4">
                        @if (isset($config))
                            <p class="alert alert-info">
                                <strong>Thiết lập hiện tại:</strong> hệ thống sẽ xoá các Freight có <code>updated_at</code>
                                là <strong>{{ $config->duration }} tháng</strong>.
                            </p>
                        @else
                            <p class="alert alert-warning">
                                <strong>Chưa thiết lập cấu hình xoá dữ liệu Freight.</strong> Vui lòng chọn thời gian bên
                                dưới để hệ thống tự động xử lý.
                            </p>
                        @endif
                    </div>
                    <form action="{{ route('carrier.clean_config.update') }}" method="POST"
                        class="d-flex flex-wrap gap-4 flex-column">
                        @csrf
                        <label for="duration" class="font-weight-bold mb-2" style="font-size: 15px;">
                            Chọn khoảng thời gian xoá Freight:
                        </label>
                        <div class="d-flex align-items-center flex-wrap">
                            <div class="form-group mb-0 d-flex flex-column mr-30 mt-10">
                                <div class="d-flex align-items-center">
                                    <div class="input-group">
                                        <select name="duration" id="duration" class="form-control w-120">
                                            @foreach (DURATION as $duration)
                                                <option value="{{ $duration }}"
                                                    {{ old('duration', $config->duration ?? null) == $duration ? 'selected' : '' }}>
                                                    {{ $duration }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append align-content-center ml-2">
                                            <span class="input-group-text d-flex align-items-center">tháng</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary mt-10">Lưu thiết lập</button>
                        </div>
                    </form>
                    <div class="mt-2">
                        @error('duration')
                            <div class="text-danger text_error_name">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection()
