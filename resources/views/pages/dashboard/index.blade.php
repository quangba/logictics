@extends('layouts.app')
@section('content')

    <div class="page-content page-content-background">
        <div class="">
            <div>
                @alert
                @endalert
            </div>

            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card card-shadow">
                        <!-- Example Area -->
                        <div class="card-block">
                            <p class="text-center">
                                    <i class="icon md-triangle-up" aria-hidden="true"></i>
                                <code>100%</code> </p>
                            <div class="example">
                                <img style="width: 90%; height: 80px" src="{{asset('images/chart1.png')}}" alt="">
                            </div>
                        </div>
                        <!-- End Example Area -->
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card card-shadow">
                        <!-- Example Area -->
                        <div class="card-block">
                            <p class="text-center">
                                <i class="icon md-triangle-down" aria-hidden="true"></i>
                                <code>100%</code> </p>
                            <div class="example">
                                <img style="width: 90%; height: 80px" src="{{asset('images/chart2.png')}}" alt="">
                            </div>
                        </div>
                        <!-- End Example Area -->
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card card-shadow">
                        <!-- Example Area -->
                        <div class="card-block">
                            <p class="text-center">
                                <i class="icon md-triangle-up" aria-hidden="true"></i>
                                <code>100%</code> </p>
                            <div class="example">
                                <img style="width: 90%; height: 80px" src="{{asset('images/chart3.png')}}" alt="">
                            </div>
                        </div>
                        <!-- End Example Area -->
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card card-shadow">
                        <!-- Example Area -->
                        <div class="card-block">
                            <p class="text-center">
                                <i class="icon md-triangle-down" aria-hidden="true"></i>
                                <code>100%</code> </p>
                            <div class="example">
                                <img style="width: 90%; height: 80px" src="{{asset('images/chart4.png')}}" alt="">
                            </div>
                        </div>
                        <!-- End Example Area -->
                    </div>
                </div>

            </div>

        </div>

@endsection
<h1 style="font-size: 100px" class="text-center text-header-1 mt-60 mt-md-0">Welcome {{ Auth::user()->name }} !</h1>
@section('script')

    <script>
        document.onreadystatechange = function () {
            var state = document.readyState
            if (state == 'complete') {
                document.getElementById('interactive');
                document.getElementById('load').style.visibility="hidden";
            }
        }
    </script>

@endsection
