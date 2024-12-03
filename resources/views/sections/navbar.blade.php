@if(request()->route()->getName() == 'root')
<style>
    #mainNavbar {
        background-color: transparent;
        transition: background-color 0.3s ease-in-out;
        position: fixed;
        width: 100%;
        color: #ffffff;
        z-index: 999;
    }
    .nav-link, .navbar-brand {
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
    }
    #mainNavbar.scrolled {
        background-color: #03396c; /* Change to your preferred color */
        box-shadow: 0 .5rem 1rem rgba(0, 0, 0, 0.15);
    }
    @media (max-width: 768px) {
        #mainNavbar {
            background-color: #03396c;
            position: relative;
        }
    }
</style>
@else
<style>
    #mainNavbar {
        background-color: #03396c;
        z-index: 999;
    }
    
</style>
@endif
{{-- <nav class="navbar navbar-expand-lg  shadow p-5  @if (request()->route()->getName() == 'root') bg-primary @else bg-info @endif"> --}}
<nav id="mainNavbar" class="navbar navbar-expand-lg p-3 position-md-fixed  @if (request()->route()->getName() !== 'root') shadow @endif" >
{{-- <nav class="navbar navbar-expand-lg  shadow p-5"> --}}
    <div class="container-fluid">
        <div class="d-flex">
            <button class="navbar-toggler text-white border" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01"
            aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <i class="bx bx-menu text-white my-auto"></i>
            </button>
            <ul class="navbar-nav text-white mx-0">
                <li class="nav-item dropdown d-flex">
                    <a class="navbar-brand text-white collapse navbar-collapse" href="{{ url('/') }}">
                        <img src="{{ asset('assets/img/logo/logo.png') }}" alt="Logo" class="img-fluid mx-0 my-auto" style="max-width: 50px;">
                    </a>
                    <p class="navbar-brand d-flex">
                        <h3 class="text-warning p-0 mx-0 my-auto"><span class="text-white">MALITBOG</span>TOUR</h1>
                    </p>
                </li>
            </ul>
        </div>
        <div class="collapse navbar-collapse mt-4 mt-lg-0" id="navbarTogglerDemo01">
            {{-- @if (request()->route()->getName() == 'root') --}}
                
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown text-white">
                        <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Destinations
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg-start">
                            @foreach ($businessTypes as $businessType)
                                <li><a class="dropdown-item" href="{{ route('guests.destinations.index', ['type' => $businessType->id]) }}">{{ $businessType->name }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Contact
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg-end">
                            <li class="dropdown-item">RHU - 0939-788-3485 </li>
                            <li class="dropdown-item">MDRRMO - 0968-216-2512 </li>
                            <li class="dropdown-item">MDRRMO - 0906-651-3731 </li>
                            <li class="dropdown-item">BFP - 0965-492-7494 </li>
                            <li class="dropdown-item">BFP - 0921-4524336 </li>
                            <li class="dropdown-item">PNP - 0927-696-4108 </li>
                            <li class="dropdown-item">PNP - 0968-549-7578 </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            About
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg-end">
                            <li><a class="dropdown-item" href="{{ route('history') }}">History</a></li>
                            <li><a class="dropdown-item" href="{{ route('news-events') }}">News and Events</a></li>
                            <li><a class="dropdown-item" href="{{ route('officials') }}">Tourism Officials</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-warning font-weight-bold" aria-current="page" href="{{ route('login') }}">LOGIN</a>
                    </li>
                </ul>
            {{-- @endif --}}
        </div>
    </div>
</nav>
<script>
    window.addEventListener('scroll', function() {
        const navbar = document.getElementById('mainNavbar');
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });
</script>
