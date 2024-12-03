@extends('layouts/blankLayout')

@section('title', 'News and Events')

@section('content')
    <x-navbar />
    <style>
        .custom-spacing .card {
            margin-bottom: 20px; /* Adjust this value as needed */
        }
    </style>
    <div class="container-fluid py-5">
        <div class="container-fluid row" 
         style="background-size: 400% 400%; animation: gradientAnimation 6s ease infinite; width: 100%; margin: 0;">
            <div class="d-flex flex-column">
                <h3 style="font-weight: 700; text-shadow: 4px 4px 4px #fff;" class="text-warning">NEWS</h3>
                <hr class="text-secondary">
                <div class="row custom-spacing">
                    @forelse ($newses as $news)
                        <div class="col-md-6 col-lg-4">
                            <div class="card ">
                                <div class="card-body">
                                    <div class="card-title d-flex">
                                        <span class="me-auto fs-4">{{ $news->title }}</span>
                                        <small>{{ $news->formatted_date }}</small>
                                    </div>
                                    <a href="{{ route('news-events-view', ['type' => 'news', 'id' => $news->id]) }}"
                                        class="btn btn-primary">See more<i class="bx bx-right-arrow-alt"></i></a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-dark">No Item</p>
                    @endforelse
                </div>
            </div>
            <div class="d-flex flex-column mt-5">
                <h3 style="font-weight: 700; text-shadow: 4px 4px 4px #fff;" class="text-warning">EVENTS</h3>
                <hr class="text-secondary">
                <div class="row custom-spacing">
                    @forelse ($events as $event)
                        <div class="col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex">
                                        <span class="me-auto fs-4">{{ $event->title }}</span>
                                        <small>{{ $event->formatted_date }}</small>
                                    </div>
                                    <a href="{{ route('news-events-view', ['type' => 'events', 'id' => $event->id]) }}"
                                        class="btn btn-primary">See more<i class="bx bx-right-arrow-alt"></i></a>
                                </div>
                            </div>
                        </div>
                    @empty
                        No Item
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    @include('footer')
@endsection
