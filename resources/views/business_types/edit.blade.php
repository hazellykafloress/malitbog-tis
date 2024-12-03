@extends('layouts/contentNavbarLayout')

@section('title', 'Update Business Type')

@section('content')
    <div class="row">
        <div class="col-xl">
            <form method="POST" action="{{ route('business-types.update', ['business_type' => $businessType]) }}">
                @csrf
                @method('PUT')
                <div class="d-flex justify-content-end mb-3">
                    <button type="submit" class="btn btn-primary d-flex gap-1">
                        <i class="bx bx-plus"></i>
                        Update
                    </button>
                    <button class="btn btn-secondary d-flex gap-1 ms-2">
                        <a href="{{ route('business-types.index') }}" class="text-white">
                            <i class="bx bx-arrow-back"></i>
                            Back
                        </a>
                    </button>
                </div>
                <div class="card mb-6">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Business Type Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-6">
                            <label class="form-label" for="name">Name <small class="text-danger">*</small></label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Starbucks"
                                value="{{ old('name') ?? $businessType->name }}" />
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

