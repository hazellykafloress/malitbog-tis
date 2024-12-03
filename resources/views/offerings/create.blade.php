@extends('layouts/layoutWithScript')

@section('title', 'Create Offering')

@section('content')
    <div class="row">
        <div class="col-xl">
            <form method="POST" action="{{ route('offerings.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="d-flex justify-content-end mb-3">
                    <button id="" type="submit" class="btn btn-primary d-flex gap-1">
                        <i class="bx bx-plus"></i>
                        Save
                    </button>
                    <button class="btn btn-secondary d-flex gap-1 ms-2">
                        <a href="{{ route('offerings.index') }}" class="text-white">
                            <i class="bx bx-arrow-back"></i>
                            Back
                        </a>
                    </button>
                </div>
                <div class="card mb-6">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Business Offering Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-6">
                            <label class="form-label" for="establishment">Establishment <small
                                    class="text-danger">*</small></label>
                            <select name="establishment" id="select_mode" class="select_mode form-select">
                                <option value="">Select one</option>
                                @foreach ($establishments as $establishment)
                                    <option value="{{ $establishment->id }}">{{ $establishment->name }}</option>
                                @endforeach
                            </select>
                            @error('establishment')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label class="form-label" for="name">Name <small class="text-danger">*</small></label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Free Food"
                                value="{{ old('name') }}" />
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label class="form-label" for="image">Image</label>
                            <input type="file" name="image" id="image" class="form-control"
                                value="{{ old('image') }}" accept="image/*">
                            @error('image')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label class="form-label" for="description">Description <small
                                    class="text-danger">*</small></label>

                            <textarea id="description" name="description" class="form-control" rows="30">{{ old('description') }}</textarea>
                            @error('description')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label class="form-label" for="price">Price <small class="text-danger">*</small></label>
                            <input type="number" class="form-control" id="price" name="price" placeholder="Free Food"
                                value="{{ old('price') }}" />
                            @error('price')
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
            $('.select_mode').select2()
            $('#description').summernote({
                height: 500
            })
        });
    </script>
@endsection
