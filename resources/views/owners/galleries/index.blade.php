@extends('layouts/contentNavbarLayout')

@section('title', 'Galleries')

@section('content')
    <livewire:owner-gallery :establishment=$establishment />
@endsection
