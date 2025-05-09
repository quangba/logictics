@extends('layouts.app')
@section('content')

    <div class="page-content page-content-background">
        <div class="">
            <div>
                @alert
                @endalert
            </div>

            <div class="row">
                <div class="col-xl-4 col-md-6">
                    <div class="card card-shadow">
                        <!-- Example Area -->
                        <div class="card-block">
                            <div class="example">
                                <img style="width: 100%; height: 350px;" src="{{asset('images/image1.jpeg')}}" alt="">
                            </div>
                        </div>
                        <!-- End Example Area -->
                    </div>
                </div>

                <div class="col-xl-4 col-md-6">
                    <div class="card card-shadow">
                        <!-- Example Area -->
                        <div class="card-block">
                            <div class="example">
                                <img style="width: 100%; height: 350px;" src="{{asset('images/image2.jpeg')}}" alt="">
                            </div>
                        </div>
                        <!-- End Example Area -->
                    </div>
                </div>

                <div class="col-xl-4 col-md-6">
                    <div class="card card-shadow">
                        <!-- Example Area -->
                        <div class="card-block">
                            <div class="example">
                                <img style="width: 100%; height: 350px;" src="{{asset('images/image3.jpeg')}}" alt="">
                            </div>
                        </div>
                        <!-- End Example Area -->
                    </div>
                </div>

                <div class="col-xl-4 col-md-6">
                    <div class="card card-shadow">
                        <!-- Example Area -->
                        <div class="card-block">
                            <div class="example">
                                <img style="width: 100%; height: 350px;" src="{{asset('images/image4.jpeg')}}" alt="">
                            </div>
                        </div>
                        <!-- End Example Area -->
                    </div>
                </div>

                <div class="col-xl-4 col-md-6">
                    <div class="card card-shadow">
                        <!-- Example Area -->
                        <div class="card-block">
                            <div class="example">
                                <img style="width: 100%; height: 350px;" src="{{asset('images/image5.jpeg')}}" alt="">
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
