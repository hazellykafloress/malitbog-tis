@extends('layouts/blankLayout')

@section('title', 'Officials')

@section('content')
    <x-navbar />
    <!-- Officials Start -->
    <div class="container-fluid py-5">
        <div class="container pt-5 pb-3">
            <div class="text-center mb-3 pb-3">
                <h6 class="text-warning text-uppercase" style="letter-spacing: 5px;">Officials</h6>
                <h2 class="text-light-blue">Our Malitbog Officials</h2>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-6 pb-2">
                    <div class="team-item bg-white mb-4">
                        <div class="team-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="{{ asset('assets/img/images/team-1.jpg') }}" alt="">
                            <div class="team-social">
                                <a class="btn btn-outline-primary btn-square" href=""><i class="fab fa-facebook-f"></i></a>
                            </div>
                        </div>
                        <div class="text-center py-4">
                            <h5 class="text-truncate">Mr. Jason Bacalla</h5>
                            <p class="m-0">Laborer/Tourism Staff</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 pb-2">
                    <div class="team-item bg-white mb-4">
                        <div class="team-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="{{ asset('assets/img/images/team-2.jpg') }}" alt="">
                            <div class="team-social">
                                <a class="btn btn-outline-primary btn-square" href=""><i class="fab fa-facebook-f"></i></a>
                            </div>
                        </div>
                        <div class="text-center py-4">
                            <h5 class="text-truncate">Mr. Antonio S. Lura Sr.</h5>
                            <p class="m-0">Municipal Mayor</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 pb-2">
                    <div class="team-item bg-white mb-4">
                        <div class="team-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="{{ asset('assets/img/images/team-3.jpg') }}" alt="">
                            <div class="team-social">
                                <a class="btn btn-outline-primary btn-square" href=""><i class="fab fa-facebook-f"></i></a>
                            </div>
                        </div>
                        <div class="text-center py-4">
                            <h5 class="text-truncate">Mr. Jesse Cabarrubias</h5>
                            <p class="m-0">Job Order/Tourism Staff</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 pb-2">
                    <div class="team-item bg-white mb-4">
                        <div class="team-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="{{ asset('assets/img/images/team-4.jpg') }}" alt="">
                            <div class="team-social">
                                <a class="btn btn-outline-primary btn-square" href=""><i class="fab fa-facebook-f"></i></a>
                            </div>
                        </div>
                        <div class="text-center py-4">
                            <h5 class="text-truncate">Mr. Alrico M. Comajig</h5>
                            <p class="m-0">Municipal Tourism Designate</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Officials End -->
    @include('footer')



@endsection
