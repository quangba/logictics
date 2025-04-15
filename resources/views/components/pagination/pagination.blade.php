@if ($paginator->hasPages())
    <div class="row pb-30">
        <div class="col-12">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <div class="col-6 float-left">
                    <button class="btn btn-block ladda-button waves-effect waves-classic" style="width: max-content;">
                        <span class="ladda-label"><i class="icon md-long-arrow-left mr-10"></i>@lang('pagination.previous')</span>
                    </button>
                </div>
            @else
                <div class="col-6 float-left">
                    <button class="btn btn-info ladda-button waves-effect waves-classic" style="width: max-content;" onclick="location.href='{{ $paginator->previousPageUrl() }}'">
                        <span class="ladda-label"><i class="icon md-long-arrow-left mr-10"></i>@lang('pagination.previous')</span>
                    </button>
                </div>
            @endif

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <div class="col-6 float-right">
                    <button type="submit" class="btn btn-info ladda-button waves-effect waves-classic" onclick="location.href='{{ $paginator->nextPageUrl() }}'">
                        <span class="ladda-label">@lang('pagination.next')<i class="icon md-long-arrow-right ml-10"></i></span>
                    </button>
                </div>
            @else
                <div class="col-6 float-right">
                    <button type="submit" class="btn btn-block ladda-button waves-effect waves-classic">
                        <span class="ladda-label">@lang('pagination.next')<i class="icon md-long-arrow-right ml-10"></i></span>
                    </button>
                </div>
            @endif
        </div>
    </div>
@endif
