@extends('layouts/blankLayout')

@section('title', 'Forgot Password Basic - Pages')

@section('page-style')
    @vite(['resources/assets/vendor/scss/pages/page-auth.scss'])
@endsection
<style>
    body {
         background: linear-gradient(45deg, #1e90ff, #ff6347, #1e90ff), url('{{ asset("assets/img/background/malitbog-background.jpg") }}');
         background-size: cover;
         background-repeat: no-repeat;
         background-attachment: fixed;
     }
     .authentication-wrapper::before {
         content: '';
         position: fixed;
         top: 0;
         left: 0;
         height: 100%;
         width: 100%;
         background-color: rgba(255, 255, 255, 0.5);
         z-index: -1;
     }
     
     /* Apply a background gradient to the authentication-inner */
     .authentication-inner {
         width: 100%;
         max-width: 100px; /* Adjust form size as needed */
         margin-top: 1vh; /* Space from top */
         border-radius: 12px;
         background: #ffffff; /* Aqua gradient */
         box-shadow: 0 2px 4px rgba(0, 0, 0, 0.15), 0 4px 10px rgba(0, 0, 0, 0.2); /* Soft 3D shadow */
         transform: translateY(-4px);
         transition: transform 0.2s ease, box-shadow 0.2s ease;
     }
     
     /* Apply a subtle gradient to card body */
     .card-body {
         background: rgba(255, 255, 255, 0.8); /* Slight white transparency for card body */
         padding: 2rem;
         border-radius: 10pxx;
     }

     .app-brand img {
         max-width: 120px;
     }
</style>

@section('content')
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">

                <!-- Forgot Password -->
                <div class="card px-sm-6 px-0">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center my-0">
                            <img class="app-brand gap-2" src="{{ asset('assets/img/logo/logo.png') }}"> <!-- Adjust the max-width as needed -->
                        </div>
                        <h5 class="text-center mt-0">Malitbog Tourism Website</h5>

                        <!-- /Logo -->
                        <h4 class="mb-1">Forgot Password? 🔒</h4>
                        <p class="mb-6">Enter your email and we'll send you instructions to reset your password</p>
                        @if (session()->has('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session()->get('status') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        <form id="formAuthentication" class="mb-6" action="{{ url('/forgot-password') }}" method="POST">
                            @csrf
                            <div class="mb-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email"
                                    placeholder="Enter your email" autofocus>
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <button class="btn btn-primary d-grid w-100">Send Reset Link</button>
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
