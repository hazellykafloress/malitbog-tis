@extends('layouts/blankLayout')

@section('title', 'Forgot Password Basic - Pages')

@section('page-style')
    @vite(['resources/assets/vendor/scss/pages/page-auth.scss'])
@endsection

@section('content')
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">

                <!-- Forgot Password -->
                <div class="card px-sm-6 px-0">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center">
                            <a href="{{ url('/') }}" class="app-brand-link gap-2">
                                Logo here
                            </a>
                        </div>
                        <!-- /Logo -->
                        <form id="formAuthentication" class="mb-6" action="{{ url('/reset-password') }}" method="POST">
                            @csrf
                            <input type="hidden" name="token" value="{{ request()->token }}">
                            <div class="mb-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email"
                                    value="{{ request()->email }}" placeholder="Enter your email" autofocus>
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-6">
                                <label for="password" class="form-label">New Password</label>
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Enter your new password" autofocus>
                                @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-6">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation" placeholder="Confirm your password" autofocus>
                            </div>
                            <button class="btn btn-primary d-grid w-100">Change password</button>
                        </form>
                        <div class="text-center">
                            <a href="{{ url('/login') }}" class="d-flex justify-content-center">
                                <i class="bx bx-chevron-left scaleX-n1-rtl me-1"></i>
                                Back to login
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /Forgot Password -->
            </div>
        </div>
    </div>
@endsection
