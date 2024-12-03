@extends('layouts/layoutWithScript')

@section('title', 'Update News Headline')

@section('content')
    <div class="row">
        <div class="col-xl">
            <form method="POST" action="{{ route('news.update', ['news' => $news]) }}">
            {{-- <form method="POST" action="{{ route('news.update') }}"> --}}
                @csrf
                @method('PUT')
                <div class="d-flex justify-content-end mb-3">
                    <button id="" type="submit" class="btn btn-primary d-flex gap-1">
                        <i class="bx bx-plus"></i>
                        Update
                    </button>
                    <button class="btn btn-secondary d-flex gap-1 ms-2">
                        <a href="{{ route('news.index') }}" class="text-white">
                            <i class="bx bx-arrow-back"></i>
                            Back
                        </a>
                    </button>
                </div>
                <div class="card mb-6">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">News Headline Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-6">
                            <label class="form-label" for="title">Title <small class="text-danger">*</small></label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Free Food"
                                value="{{ old('title', $news->title) }}" />
                            @error('title')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label class="form-label" for="description">Description <small
                                    class="text-danger">*</small></label>

                            <textarea id="description" name="description" class="form-control" rows="50">{{ old('description', $news->description) }}</textarea>
                            @error('description')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection



@section('jsScripts')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.js"></script>
    <script async>
        $(document).ready(function() {
            $('#description').summernote({
                height: 500
            })
        });
    </script>
@endsection
