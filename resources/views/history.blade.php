@extends('layouts/blankLayout')

@section('title', 'History')

@section('content')
    <x-navbar />

    <style>
        /* Responsive styling for text */
        p {
            text-align: justify;
            text-justify: inter-word;
        }
        .indent {
            text-indent: 2rem;
        }
    </style>
    
    <div class="container-fluid py-5">
        <div class="container pt-5">
            <div class="row">
                <div class="col-lg-6" style="min-height: 500px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute w-100 h-100" src="{{ asset('assets/img/elements/dance.jpg') }}" style="object-fit: cover;">
                    </div>
                </div>
                <div class="col-lg-6 pt-5 pb-lg-5">
                    <div class="about-text bg-white p-4 p-lg-5 my-lg-5">
                        <h6 class="text-warning text-uppercase" style="letter-spacing: 5px;">About Municipality</h6>
                        <h1 class="mb-3">Know more about the History of Malitbog</h1>
                        <p class="indent">Malitbog, a town in the Philippines, was established in the 18th century by the Spanish. The town was divided into two barangays, one in Barangay Caaga and the other in Barangay Abgaom, which were ruled by their respective chieftains, called "captines." The rivalry between the two barangays led to confusion, and the name "MALITBOG" was given to the established pueblo. In 1857, a baroque-style Roman Catholic Church was built in the middle of the two barangays, with the demarcation line serving as the line. In 1862, a "carcel" was constructed to warn settlers from Moro pirate attacks. Malitbog was recognized under the Muara</p>
                        <div class="row justify-content-center align-items-center">
                            <div class="col pb-1">
                                <!-- Start of Carousel with Continuous Slide Effect -->
                                <div id="imageCarousel" class="carousel slide carousel-3d" data-bs-ride="carousel" data-bs-interval="3000" data-bs-pause="false">
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <img  src="{{ asset('assets/img/elements/church.jpg') }}" height="250" class="d-block w-100" alt="Malitbog Church">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="{{ asset('assets/img/elements/dance.jpg') }}" height="250" class="d-block w-100" alt="Second Image">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="{{ asset('assets/img/elements/santo.jpg') }}" height="250" class="d-block w-100" alt="Third Image">
                                        </div>
                                    </div>
                                    <!-- Carousel Controls -->
                                    <button class="carousel-control-prev" type="button" data-bs-target="#imageCarousel" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#imageCarousel" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <p class="indent">Under the Law of 1893, Malitbog was reorganized under the Maura Law of 1893, which granted towns and provinces greater autonomy and the establishment of "tribunales municipals" and "junta provincial." The town's territorial limits covered 19 kilometers south of the Poblacion, including the island of Limasawa. During the American regime, Malitbog was recognized under Act No. 82, known as the Municipal Code, and the first Municipal President was Francisco Escaño. The town's Municipal Hall was later transferred to another private house. In 1957, the Municipality of Padre Burgos was created, and in 1969, several barrios to the north were transferred under the jurisdiction of the newly-created Municipality of Tomas Oppus.</p>
                        <div class="row mb-4">
                            <div class="col-6">
                                <img class="img-fluid" src="{{ asset('assets/img/images/beach.jpg') }}" alt="">
                            </div>
                            <div class="col-6">
                                <img class="img-fluid" src="{{ asset('assets/img/images/church1.jpg') }}" alt="">
                            </div>
                        </div>
                        <button class="btn btn-success mt-1">#ilovemalitbog</button>
                        <button class="btn btn-primary mt-1">#itsmorefuninmalitbog</button>
                        <button class="btn btn-info mt-1">#visitmalitbog</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="container-fluid py-5 bg-white">        
        <!-- Main Content with Background -->
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-8">
                <!-- Start of Carousel with Continuous Slide Effect -->
                <div id="imageCarousel" class="carousel slide carousel-3d" data-bs-ride="carousel" data-bs-interval="3000" data-bs-pause="false">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img  src="{{ asset('assets/img/elements/church.jpg') }}" height="450" class="d-block w-100" alt="Malitbog Church">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('assets/img/elements/dance.jpg') }}" height="450" class="d-block w-100" alt="Second Image">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('assets/img/elements/santo.jpg') }}" height="450" class="d-block w-100" alt="Third Image">
                        </div>
                    </div>
                    <!-- Carousel Controls -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#imageCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#imageCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div> --}}
    @include('footer')
@endsection
