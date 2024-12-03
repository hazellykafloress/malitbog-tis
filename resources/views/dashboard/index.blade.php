@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard - Analytics')

@section('vendor-style')
    @vite('resources/assets/vendor/libs/apex-charts/apex-charts.scss')
@endsection

@section('vendor-script')
    @vite('resources/assets/vendor/libs/apex-charts/apexcharts.js')
@endsection

@section('page-script')
    <script>
        window.incomeChartData = @json($growth);
    </script>
    </script>
    @vite('resources/assets/js/dashboards-analytics.js')
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 mb-6">
            <div class="card border-0">
                <div class="d-flex align-items-start row">
                    <div class="col-sm-5">
                        <div class="card-body">
                            <h5 class="card-title text-primary mb-3">Welcome back {{ $user->name }}! 🎉</h5>
                            <p class="mb-6">Let's take a look on what is system's progress lately.
                            </p>
                            {{-- <a href="javascript:;" class="btn btn-sm btn-outline-primary">View Badges</a> --}}
                        </div>
                    </div>
                    <div class="col-sm-7 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-6">
                            <img src="{{ asset('assets/img/illustrations/man-with-laptop.png') }}" height="175"
                                class="scaleX-n1-rtl" alt="View Badge User">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-lg-3 col-md-12 col-6 mb-6">
                  <div class="card h-100 border-0">
                    <div class="card-body">
                      <div class="card-title d-flex align-items-start justify-content-between mb-4">
                        <div class="avatar flex-shrink-0 m-auto">
                          <img src="{{asset('assets/img/icons/unicons/wallet-info.png')}}" alt="chart success" class="rounded">
                        </div>
                      </div>
                      <p class="mb-1">Owners</p>
                      <h4 class="card-title mb-3"> {{ $owners }} </h4>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3 col-md-12 col-6 mb-6">
                  <div class="card h-100 border-0">
                    <div class="card-body">
                      <div class="card-title d-flex align-items-start justify-content-between mb-4">
                        <div class="avatar flex-shrink-0 m-auto">
                          <img src="{{asset('assets/img/icons/unicons/wallet-info.png')}}" alt="wallet info" class="rounded">
                        </div>
                      </div>
                      <p class="mb-1">Establishments</p>
                      <h4 class="card-title mb-3"> {{$establishments}} </h4>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3 col-md-12 col-6 mb-6">
                  <div class="card h-100 border-0">
                    <div class="card-body">
                      <div class="card-title d-flex align-items-start justify-content-between mb-4">
                        <div class="avatar flex-shrink-0 m-auto">
                          <img src="{{asset('assets/img/icons/unicons/wallet-info.png')}}" alt="wallet info" class="rounded">
                        </div>
                      </div>
                      <p class="mb-1">Galleries</p>
                      <h4 class="card-title mb-3"> {{$galleries}} </h4>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3 col-md-12 col-6 mb-6">
                  <div class="card h-100 border-0">
                    <div class="card-body">
                      <div class="card-title d-flex align-items-start justify-content-between mb-4">
                        <div class="avatar flex-shrink-0 m-auto">
                          <img src="{{asset('assets/img/icons/unicons/wallet-info.png')}}" alt="wallet info" class="rounded">
                        </div>
                      </div>
                      <p class="mb-1">Offerings</p>
                      <h4 class="card-title mb-3"> {{$offerings}} </h4>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3 col-md-12 col-6 mb-6">
                  <div class="card h-100 border-0">
                    <div class="card-body">
                      <div class="card-title d-flex align-items-start justify-content-between mb-4">
                        <div class="avatar flex-shrink-0 m-auto">
                          <img src="{{asset('assets/img/icons/unicons/wallet-info.png')}}" alt="wallet info" class="rounded">
                        </div>
                      </div>
                      <p class="mb-1">News</p>
                      <h4 class="card-title mb-3"> {{$news}} </h4>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3 col-md-12 col-6 mb-6">
                  <div class="card h-100 border-0">
                    <div class="card-body">
                      <div class="card-title d-flex align-items-start justify-content-between mb-4">
                        <div class="avatar flex-shrink-0 m-auto">
                          <img src="{{asset('assets/img/icons/unicons/wallet-info.png')}}" alt="wallet info" class="rounded">
                        </div>
                      </div>
                      <p class="mb-1">Events</p>
                      <h4 class="card-title mb-3"> {{$events}} </h4>
                    </div>
                  </div>
                </div>
            </div>
        </div>
        {{-- <div class="col-lg-7 col-md-4 order-1">
            <div class="card border-0">
                <div class="card-body">
                    <div class="tab-content p-0">
                      <div class="tab-pane fade show active" id="navs-tabs-line-card-income" role="tabpanel">
                        <div class="d-flex mb-6">
                          <div class="avatar flex-shrink-0 me-3">
                            <img src="{{asset('assets/img/icons/unicons/chart.png')}}" alt="User">
                          </div>
                          <div>
                            <p class="mb-0">Establishments Growth</p>
                            <div class="d-flex align-items-center">
                              <h6 class="mb-0 me-1"> {{$establishments}} </h6>
                              <small class="text-primary fw-medium">
                                <i class='bx bx-chevron-up bx-lg'></i>
                                42.9%
                              </small>
                            </div>
                          </div>
                        </div>
                        <div id="incomeChart"></div>
                      </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <!-- Order Statistics -->
                <div class="col order-0 mb-6">
                    <div class="card h-100 border-0">
                    <div class="card-header d-flex justify-content-between">
                        <div class="card-title mb-0">
                        <h5 class="mb-1 me-2">Order Statistics</h5>
                        <p class="card-subtitle">42.82k Total Sales</p>
                        </div>
                        <div class="dropdown">
                        <button class="btn text-muted p-0" type="button" id="orederStatistics" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="bx bx-dots-vertical-rounded bx-lg"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="orederStatistics">
                            <a class="dropdown-item" href="javascript:void(0);">Select All</a>
                            <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                            <a class="dropdown-item" href="javascript:void(0);">Share</a>
                        </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-6">
                        <div class="d-flex flex-column align-items-center gap-1">
                            <h3 class="mb-1">8,258</h3>
                            <small>Total Orders</small>
                        </div>
                        <div id="orderStatisticsChart"></div>
                        </div>
                        <ul class="p-0 m-0">
                        <li class="d-flex align-items-center mb-5">
                            <div class="avatar flex-shrink-0 me-3">
                            <span class="avatar-initial rounded bg-label-primary"><i class='bx bx-mobile-alt'></i></span>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                                <h6 class="mb-0">Electronic</h6>
                                <small>Mobile, Earbuds, TV</small>
                            </div>
                            <div class="user-progress">
                                <h6 class="mb-0">82.5k</h6>
                            </div>
                            </div>
                        </li>
                        <li class="d-flex align-items-center mb-5">
                            <div class="avatar flex-shrink-0 me-3">
                            <span class="avatar-initial rounded bg-label-success"><i class='bx bx-closet'></i></span>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                                <h6 class="mb-0">Fashion</h6>
                                <small>T-shirt, Jeans, Shoes</small>
                            </div>
                            <div class="user-progress">
                                <h6 class="mb-0">23.8k</h6>
                            </div>
                            </div>
                        </li>
                        <li class="d-flex align-items-center mb-5">
                            <div class="avatar flex-shrink-0 me-3">
                            <span class="avatar-initial rounded bg-label-info"><i class='bx bx-home-alt'></i></span>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                                <h6 class="mb-0">Decor</h6>
                                <small>Fine Art, Dining</small>
                            </div>
                            <div class="user-progress">
                                <h6 class="mb-0">849k</h6>
                            </div>
                            </div>
                        </li>
                        <li class="d-flex align-items-center">
                            <div class="avatar flex-shrink-0 me-3">
                            <span class="avatar-initial rounded bg-label-secondary"><i class='bx bx-football'></i></span>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                                <h6 class="mb-0">Sports</h6>
                                <small>Football, Cricket Kit</small>
                            </div>
                            <div class="user-progress">
                                <h6 class="mb-0">99</h6>
                            </div>
                            </div>
                        </li>
                        </ul>
                    </div>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
@endsection
