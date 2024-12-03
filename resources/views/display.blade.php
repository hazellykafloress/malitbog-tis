@extends('layouts/blankLayout')
@section('title', 'News and Events')

@section('content')
    <x-navbar />
    
    <div class="container d-flex flex-column py-5">
        <div class="d-flex flex-column px-md-3">
            <span class="fs-2">{{ $toBeDisplay->title }}</span>
            @if (isset($toBeDisplay?->establishment?->name))
                <span class="fs-5"><i class="bx bx-buildings"></i>{{ $toBeDisplay->establishment->name }}</span>
            @endif
            <small> <i class="bx bx-calendar"></i>
                {{ $toBeDisplay?->formatted_date }}</small>
        </div>
        <hr>
        <div class="px-3">
            {!! $toBeDisplay->description !!}
        </div>
    </div>
    @include('footer')

@endsection
