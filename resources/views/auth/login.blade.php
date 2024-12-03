@extends('layouts/blankLayout')

@section('title', 'Login Basic - Pages')

@section('page-style')
    @vite(['resources/assets/vendor/scss/pages/page-auth.scss'])
    <style>
      
      /* Full page background with a gradient and overlay image */
     body {
         background: linear-gradient(45deg, #1e90ff, #ff6347, #1e90ff);
     }
     
     /* Overlay to soften the background */
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
         padding: 2rem;
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
     
     
     /* Adjust the logo size */
     .app-brand img {
         max-width: 120px;
     }
     
    </style>
     @endsection
     

@section('content')
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner bg-white ">
                <!-- Register -->
                <!-- Back Button -->
                <div class="mb-6 text-right padding-1rm d-flex">
                    <a href="/" class="btn btn-secondary">
                        <
                    </a>
                </div>
                <!-- Logo -->
                <div class="app-brand justify-content-center">
                    <img class="app-brand gap-2" src="{{ asset('assets/img/logo/logo.png') }}"> <!-- Adjust the max-width as needed -->
                </div>
                <!-- /Logo -->
                <h5 class="text-center">Malitbog Tourism Website</h5>


                @if (session()->has('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session()->get('status') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                    </div>
                @endif

                <form id="formAuthentication" class="mb-6" action="{{ url('/login') }}" method="POST">
                    @csrf
                    <div class="mb-6">
                        <label for="email" class="form-label" style="color: black">Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                            placeholder="Enter your email" autofocus 
                            style="color: black; border-color: black;">
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-6 form-password-toggle">
                        <label class="form-label" for="password" style="color: black">Password</label>
                        <div class="input-group input-group-merge">
                            <input type="password" id="password" class="form-control" name="password"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                aria-describedby="password"  style= "color: black; border-color: black;" />
                            <span class="input-group-text cursor-pointer" style=" color: black; border-color: black;"><i class="bx bx-hide "></i></span>
                        </div>
                    </div>

                    <div class="mb-8">
                        <div class="d-flex justify-content-between mt-8">
                            <div class="form-check mb-0 ms-2">
                            </div>
                            <a href="{{ url('/forgot-password') }}" style="color: black;">
                                <span>Forgot Password?</span>
                            </a>
                        </div>
                    </div>

                    <div class="mb-6">
                        <button class="btn btn-primary d-grid w-100" type="submit">Login</button>
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="{{ url('/apply') }}" class="btn btn-success rounded w-100">
                            Apply your Establishment
                        </a>
                    </div>
                </form>
            </div>
            
        </div>
    </div>
    @livewireStyles
    @livewireScripts
    @if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Success',
                text: "Establishment has been added!",
                icon: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK',
                customClass: {
                    title: 'alert-title',
                    icon: 'alert-icon',
                    confirmButton: 'alert-confirmButton',
                    cancelButton: 'alert-cancelButton',
                    container: 'alert-container',
                    popup: 'alert-popup'
                },
            }).then(() => {
                @php
                    session()->forget('success');
                @endphp
            });
        });
    </script>
    @endif

    @if(session('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Error',
                text: "Something went wrong on your application!",
                icon: 'error',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK',
                customClass: {
                    title: 'alert-title',
                    icon: 'alert-icon',
                    confirmButton: 'alert-confirmButton',
                    cancelButton: 'alert-cancelButton',
                    container: 'alert-container',
                    popup: 'alert-popup'
                },
            }).then(() => {
                @php
                    session()->forget('error');
                @endphp
            });
        });
    </script>
    @endif
@endsection
