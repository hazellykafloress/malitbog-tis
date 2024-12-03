@extends('layouts/blankLayout')

@section('content')
    <x-navbar />

  <!-- Blog End -->
    <div class="container-fluid d-flex flex-column justify-content-center py-5 gap-5">
      <div class="text-center mb-3 pb-3">
        <h6 class="text-warning text-uppercase" style="letter-spacing: 5px;">Establishment</h6>
        <h2 class="text-center text-light-blue">{{ $businessType->name }}</h2>
      </div>

      {{-- <div class="card shadow p-4">
        <livewire:destination-table businessTypeId="{{$businessType->id}}" />
      </div>
       --}}
    <!-- Blog Start -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="row pb-3 d-flex">
                    @foreach ($establishments as $establishment)
                    <div class="col-md-4 mb-4 pb-2 d-flex align-items-stretch">
                      <div class="blog-item bg-white d-flex flex-column shadow">
                        <div class="position-relative">
                          <img class="img-fluid w-100" src="{{ asset('storage/' . str_replace('public/', '', $establishment->path)) }}" alt="Establishment Image">
                          <div class="blog-date">
                              <h6 class="font-weight-bold mb-n1 text-white">{{ $loop->iteration }}</h6>
                          </div>
                        </div>
                        <div class="p-4">
                            <div class="d-flex">
                                <p class="text-primary text-uppercase text-decoration-none">{{$establishment->owner}}</p>
                                <span class="text-primary px-2">|</span>
                                <p class="text-warning text-uppercase text-decoration-none">{{$establishment->name}}</p>
                            </div>
                            <p class="h5 m-0 text-decoration-none"> {{$establishment->description}} </p>
                            <a class="btn btn-sm btn-warning mt-3" href="{{ route('guests.destinations.show', ['type' => $businessType->id, 'id' => $establishment->id]) }}">
                              See More
                            </a>
                        </div>
                      </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
      </div>
    </div>
    @include('footer')


@endsection
