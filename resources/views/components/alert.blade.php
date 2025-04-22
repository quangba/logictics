@if ($response = session()->get('response'))
    <div class="alert dark alert-icon {{ $response['error'] ? 'alert-danger' : 'alert-success' }} alert-dismissible"
        role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <i class="icon {{ $response['error'] ? 'md-alert-circle-o' : 'md-check' }}" aria-hidden="true"></i>
        <span class="pl-20 pl-md-10">
            {{ $response['message'] }}
        </span>
    </div>
@endif
