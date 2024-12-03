@extends('layouts/blankLayout')

@section('title', 'Homepage')

@section('content')
    <x-navbar />

    <style>
      .vision-mission-box {
        padding: 20px; /* Padding inside the box */
        background-color: #fff; /* White background */
        border-radius: 15px; /* Rounded corners for smooth look */
        box-shadow: 
            0 4px 6px rgba(0, 0, 0, 0.1), /* Light shadow for outer depth */
            0 2px 10px rgba(0, 0, 0, 0.2), /* Deeper shadow */
            inset 0 0 8px rgba(0, 0, 0, 0.1); /* Inner shadow for the 3D effect */
        transform: translateY(10px); /* Slightly elevated position for 3D effect */
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out; /* Smooth hover effect */
      }

      .vision-mission-box:hover {
        transform: translateY(-5px); /* Hover effect to elevate the box */
        box-shadow: 
            0 6px 12px rgba(0, 0, 0, 0.2), /* Stronger shadow on hover */
            0 4px 15px rgba(0, 0, 0, 0.3), 
            inset 0 0 10px rgba(0, 0, 0, 0.15); /* Stronger inner shadow on hover */
      }
      .bg-video-container {
          position: relative;
          width: 100%;
          height: 65vh; /* Adjust height as needed */
          overflow: hidden;
      }

      .bg-video-container iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border: 0;
        z-index: -1; /* Ensure the video is in the background */
      }

      .welcome-text {
        color: white;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
        position: relative; /* Required for clock positioning */
      }

        /* Clock Styling */
      .clock {
        position: absolute;
        top: 100px;  /* Adjust the top position to move the clock further down */
        font-family: 'Arial', sans-serif;
        font-weight: bold;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
        position: absolute;
        bottom: 120px; /* Position the button at the bottom */
        left: 90%;
        transform: translateX(-50%); /* Center the button horizontally */
        font-size: 20px;
        color: #ffffff;
      }
        /* Positioning the container for logo and text */
      .app-brand {
        position: relative;
      }

      .gradientAnimation {
      0% {
        background-position: 0% 50%;
      }
      50% {
        background-position: 100% 50%;
      }
      100% {
        background-position: 0% 50%;
      }
    }
    .carousel-container {
      position: relative;
      width: 100vw;           /* Full width of the viewport */
      max-width: 100%;        /* Ensure it takes the entire width */
      height: 400px;          /* Set a specific height for the carousel */
      margin: 0;              /* Remove any margin */
      overflow: hidden;       /* Hides overflow content */
      border-radius: 0px;     /* Remove rounded corners */
      box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); /* Soft shadow */
    }

    /* Slide Wrapper */
    .carousel-slide {
      display: flex;                         /* Aligns slides in a row */
      transition: transform 0.5s ease;       /* Smooth transition for slide movement */
    }

    /* Individual Slide */
    .carousel-slide img {
      width: 100%;                           /* Makes each image fill the container's width */
      height: 400px;                         /* Adjust the height to your desired value */
      object-fit: cover;                     /* Ensures images maintain aspect ratio and fill container */
    }

    /* Navigation Buttons */
    .prev, .next {
      position: absolute;                    /* Positions the buttons over the carousel */
      top: 50%;                              /* Centers buttons vertically */
      transform: translateY(-50%);           /* Corrects alignment */
      font-size: 24px;                       /* Larger font for easy clicking */
      color: white;                          /* White color for contrast */
      background-color: rgba(0, 0, 0, 0.5);  /* Semi-transparent background */
      padding: 8px;                          /* Adds padding for clickability */
      border-radius: 50%;                    /* Circular button style */
      cursor: pointer;                       /* Pointer cursor on hover */
      z-index: 10;                           /* Keeps buttons above slides */
    }

    .prev {
      left: 10px;                            /* Positions "previous" button on the left */
    }

    .next {
      right: 10px;                           /* Positions "next" button on the right */
    }

    /* Dots Navigation (Optional) */
    .carousel-dots {
      text-align: center;
      padding: 10px 0;
      position: absolute;
      bottom: 10px;
      width: 100%;
      display: flex;
      justify-content: center;
    }

    .dot {
      height: 10px;
      width: 10px;
      margin: 0 5px;
      background-color: #bbb;
      border-radius: 50%;
      display: flex;
      cursor: pointer;
    }

    .dot.active {
      background-color: #4CC9FE;
    }

    .bg-video-container {
        position: relative;
        width: 100%;
        height: 100vh; /* Full viewport height */
        overflow: hidden;
    }

    .bg-video-container video {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover; /* Ensures the video covers the entire container */
        z-index: -1; /* Puts the video behind content */
    }

    .scroll-down-button {
      position: absolute;
      bottom: 100px; /* Position the button at the bottom */
      left: 50%;
      transform: translateX(-50%); /* Center the button horizontally */
      font-size: 20px;
      color: #ffffff;
      text-decoration: none;
      transition: all 0.3s ease;
      border: 1px solid white;
      background: none; 
    }

    .scroll-down-button:hover {
      transform: translateX(-50%) translateY(5px); /* Slightly lower the button on hover */
      color: #ffffff;
      background: #005b96;
      border: none;
    }

    .scroll-down-button span {
      display: inline-block;
      transform: translateY(5px); /* Adjust arrow positioning */
    }

    .title {
      font-size: 4rem;
      line-height: 5rem;
    }
    .title-container {
      position: absolute;
      top: 25%;
      left: 50%;
      transform: translateX(-50%); 
    }

    #next-section {
      padding-top: 100px;
      padding-bottom: 100px;
    }

    @media only screen and (max-width: 876px) {
      .welcome-text {
        font-size: 1rem;
      }
      .title {
        font-size: 2rem;
        line-height: 2rem;
      }
      .title-container {
        top: 10%;
      }
    }

    </style>
    <div class="clock d-none d-lg-block" id="clock"></div>
    <div class="bg-video-container">
      <video autoplay muted loop playsinline>
          <source src="{{ asset('assets/img/backgrounds/malitbog.mp4') }}" type="video/mp4">
          Your browser does not support the video tag.
      </video>
      <div class="content-overlay  title-container">
          <!-- Your content goes here -->
          <div class="container-fluid text-center">
            <a href="{{ url('/') }}">
              <img src="{{ asset('assets/img/logo/logo.png') }}" alt="Logo" class="img-fluid" width="200" height="200" style="max-width: 100px;">
            </a>
            <h5 class="welcome-text my-0 text-uppercase">Republic of the Philippines</h5>
            <h1 class="welcome-text title my-0 " 
              style="font-family: 'Charm', cursive; font-weight: 700; ">
              Municipality of Malitbog
            </h1>
          </div>
      </div>
      <a href="#next-section" class="d-none d-lg-block scroll-down-button rounded-pill px-3 pt-2 pb-3">
        <span>GET START  <i class="bx bx-chevron-down text-white"></i></span>
      </a>
    </div>
    <!-- Mission Vision Start -->
    <div class="container-fluid py-5" id="next-section">
      <div class="container pt-5 pb-3">
          <div class="text-center mb-3 pb-3">
              <h6 class="text-warning text-uppercase" style="letter-spacing: 5px;">MISSION & VISION</h6>
          </div>
          <div class="row d-flex">
              <div class="col-lg-6 col-md-6 mb-4 d-flex align-items-stretch">
                  <div class="service-item bg-white text-center mb-2 py-5 px-4">
                      <i class="fa fa-2x fa-lightbulb mx-auto mb-4"></i>
                      <h5 class="mb-2">VISION</h5>
                      <p class="m-0">A center of arts and culture in the province of southern leyte, with a progressive, sustainable, and diverse economy, a disaster-resilient community, strengthened social organizations, and empowered citizenry living in an ecologically balanced, safe, peaceful, and attractive environment with competent, transparent, accountable, and responsive governance.</p>
                  </div>
              </div>
              <div class="col-lg-6 col-md-6 mb-4 d-flex align-items-stretch">
                  <div class="service-item bg-white text-center mb-2 py-5 px-4">
                      <i class="fa fa-2x fa-fire mx-auto mb-4"></i>
                      <h5 class="mb-2">MISSION</h5>
                      <p class="m-0">The municipality will provide holistic and sustainable socio-economic programs and social services that contribute to improving the quality of life for its constituents, promote ecological balance through preservation and conservation, enforce peace and order for a just and humane society, and nurture people empowerment through strengthened social organizations under efficient and quality leadership.</p>
                  </div>
              </div>
          </div>
      </div>
    </div>
    <!-- Mission Vision End -->
    <!-- Destination Start -->
    <div class="container-fluid py-5">
      <div class="container pt-5 pb-3">
          <div class="text-center mb-3 pb-3">
              <h6 class="text-warning text-uppercase " style="letter-spacing: 5px;">Destination</h6>
              <h2 class="text-light-blue">Explore Top Destination</h2>
          </div>
          <div class="row">
              @foreach ($establishments as $establishment)
              <div class="col-lg-4 col-md-6 mb-4">
                  <div class="destination-item position-relative overflow-hidden mb-2">
                    <img class="img-fluid" src="{{asset('assets/img/images/destination-2.jpg')}}" alt="">
                      <a class="destination-overlay text-white text-decoration-none" href="{{ route('guests.destinations.show', ['type' => $establishment->business_type_id, 'id' => $establishment->id]) }}">
                          <h5 class="text-white"> {{$establishment->name}} </h5>
                          <span>{{$establishment->owner}}</span>
                      </a>
                  </div>
              </div>
              @endforeach
          </div>
      </div>
    </div>
    <!-- Destination Start -->
    <div class="carousel-container">
      <div class="carousel-slide">
        <img src="https://southernleyte.gov.ph/wp-content/uploads/Kaplag-Uli-1.2.jpg" alt="Slide 1">
        <img src="https://southernleyte.gov.ph/wp-content/uploads/Kaplag-Uli-2-1536x1024.jpg" alt="Slide 2">
        <img src="https://southernleyte.gov.ph/wp-content/uploads/Kaplag-Uli-3-1536x1024.jpg" alt="Slide 3">
        <img src="https://southernleyte.gov.ph/wp-content/uploads/2022/10/JOHNS-WRECK-1.jpg" alt="Slide 4">
        <img src="https://southernleyte.gov.ph/wp-content/uploads/2022/10/LITTLE-LEMBEH.jpg" alt="Slide 5">
        <img src="https://southernleyte.gov.ph/wp-content/uploads/Sto.-Nino-Church-1-1536x1020.jpg" alt="Slide 6">
        <img src="https://southernleyte.gov.ph/wp-content/uploads/DSC_0832-1536x1020.jpg" alt="Slide 7">
      </div>
      <div class="prev" onclick="moveSlide(-1)">&#10094;</div>
      <div class="next" onclick="moveSlide(1)">&#10095;</div>
    </div>
    @include('footer')

    <script>
      let slideIndex = 0;
      const carouselSlide = document.querySelector('.carousel-slide');
      const slides = document.querySelectorAll('.carousel-slide img');
      const totalSlides = slides.length;
    
      // Calculate the width of one image
      function getSlideWidth() {
        return slides[0].clientWidth;
      }
    
      // Calculate how many images fit within the container
      function getVisibleSlidesCount() {
        const containerWidth = document.querySelector('.carousel-container').clientWidth;
        const slideWidth = getSlideWidth();
        return Math.floor(containerWidth / slideWidth);
      }
    
      function showSlide(index) {
        const visibleSlides = getVisibleSlidesCount();
        const maxSlideIndex = Math.ceil(totalSlides / visibleSlides) - 1;
    
        // Loop back to the first slide if we reach the end
        slideIndex = (index + maxSlideIndex + 1) % (maxSlideIndex + 1);
        const offset = slideIndex * getVisibleSlidesCount() * getSlideWidth();
        carouselSlide.style.transform = `translateX(${-offset}px)`;
      }
    
      function moveSlide(step) {
        showSlide(slideIndex + step);
      }
    
      // Auto-slide function
      function autoSlide() {
        moveSlide(1);
        setTimeout(autoSlide, 3000); // Auto-slide every 3 seconds
      }
    
      // Initialize carousel on page load
      window.onload = function () {
        showSlide(slideIndex);
        autoSlide();
      };
    
      // Adjust carousel on window resize
      window.addEventListener('resize', () => showSlide(slideIndex));
    </script>
    
    <script>
      function updateClock() {
        const now = new Date();
        let hours = now.getHours();
        let minutes = String(now.getMinutes()).padStart(2, '0');
        let seconds = String(now.getSeconds()).padStart(2, '0');
        let ampm = hours >= 12 ? 'PM' : 'AM';
        
        hours = hours % 12; // Convert to 12-hour format
        hours = hours ? hours : 12; // The hour '0' should be '12'
        const timeString = `${hours}:${minutes}:${seconds} ${ampm}`;
        document.getElementById('clock').textContent = timeString;
      }

      setInterval(updateClock, 1000); // Update the clock every second
      updateClock(); // Initial call to display the time immediately
    </script>
@endsection
