@extends('layouts.template')

@section('title', 'Haz Creatives Studio - Gallery')

@push('styles')
    <link href="{{ asset('assets/vendor/typed.js/typed.css') }}" rel="stylesheet">
@endpush

@section('content')

    <main class="main">

        <!-- Page Title -->
        <div class="page-title" data-aos="fade">
            <div class="heading">
                <div class="container">
                    <div class="row d-flex justify-content-center text-center">
                        <div class="col-lg-8">
                            <h1>Gallery</h1>
                            <p class="mb-0">Odio et unde deleniti. Deserunt numquam exercitationem. Officiis quo odio sint
                                voluptas consequatur ut a odio voluptatem. Sit dolorum debitis veritatis natus dolores.
                                Quasi ratione sint. Sit quaerat ipsum dolorem.</p>
                            <a href="{{ route('contact') }}" class="cta-btn">Available for Hire<br></a>
                        </div>
                    </div>
                </div>
            </div>
            <nav class="breadcrumbs">
                <div class="container">
                    <ol>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li class="current">Gallery</li>
                    </ol>
                </div>
            </nav>
        </div><!-- End Page Title -->

        <!-- Gallery Section -->
        <section id="gallery" class="gallery section">

            <div class="container-fluid" data-aos="fade-up" data-aos-delay="100">

                <div class="row gy-4 justify-content-center">

                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="gallery-item h-100">
                            <img src="assets/img/gallery/gallery-1.jpg" class="img-fluid" alt="">
                            <div class="gallery-links d-flex align-items-center justify-content-center">
                                <a href="assets/img/gallery/gallery-1.jpg" title="Gallery 1"
                                    class="glightbox preview-link"><i class="bi bi-arrows-angle-expand"></i></a>
                                <a href="gallery-single.html" class="details-link"><i class="bi bi-link-45deg"></i></a>
                            </div>
                        </div>
                    </div><!-- End Gallery Item -->

                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="gallery-item h-100">
                            <img src="assets/img/gallery/gallery-2.jpg" class="img-fluid" alt="">
                            <div class="gallery-links d-flex align-items-center justify-content-center">
                                <a href="assets/img/gallery/gallery-2.jpg" title="Gallery 2"
                                    class="glightbox preview-link"><i class="bi bi-arrows-angle-expand"></i></a>
                                <a href="gallery-single.html" class="details-link"><i class="bi bi-link-45deg"></i></a>
                            </div>
                        </div>
                    </div><!-- End Gallery Item -->

                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="gallery-item h-100">
                            <img src="assets/img/gallery/gallery-3.jpg" class="img-fluid" alt="">
                            <div class="gallery-links d-flex align-items-center justify-content-center">
                                <a href="assets/img/gallery/gallery-3.jpg" title="Gallery 3"
                                    class="glightbox preview-link"><i class="bi bi-arrows-angle-expand"></i></a>
                                <a href="gallery-single.html" class="details-link"><i class="bi bi-link-45deg"></i></a>
                            </div>
                        </div>
                    </div><!-- End Gallery Item -->

                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="gallery-item h-100">
                            <img src="assets/img/gallery/gallery-4.jpg" class="img-fluid" alt="">
                            <div class="gallery-links d-flex align-items-center justify-content-center">
                                <a href="assets/img/gallery/gallery-4.jpg" title="Gallery 4"
                                    class="glightbox preview-link"><i class="bi bi-arrows-angle-expand"></i></a>
                                <a href="gallery-single.html" class="details-link"><i class="bi bi-link-45deg"></i></a>
                            </div>
                        </div>
                    </div><!-- End Gallery Item -->

                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="gallery-item h-100">
                            <img src="assets/img/gallery/gallery-5.jpg" class="img-fluid" alt="">
                            <div class="gallery-links d-flex align-items-center justify-content-center">
                                <a href="assets/img/gallery/gallery-5.jpg" title="Gallery 5"
                                    class="glightbox preview-link"><i class="bi bi-arrows-angle-expand"></i></a>
                                <a href="gallery-single.html" class="details-link"><i class="bi bi-link-45deg"></i></a>
                            </div>
                        </div>
                    </div><!-- End Gallery Item -->

                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="gallery-item h-100">
                            <img src="assets/img/gallery/gallery-6.jpg" class="img-fluid" alt="">
                            <div class="gallery-links d-flex align-items-center justify-content-center">
                                <a href="assets/img/gallery/gallery-6.jpg" title="Gallery 6"
                                    class="glightbox preview-link"><i class="bi bi-arrows-angle-expand"></i></a>
                                <a href="gallery-single.html" class="details-link"><i class="bi bi-link-45deg"></i></a>
                            </div>
                        </div>
                    </div><!-- End Gallery Item -->

                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="gallery-item h-100">
                            <img src="assets/img/gallery/gallery-7.jpg" class="img-fluid" alt="">
                            <div class="gallery-links d-flex align-items-center justify-content-center">
                                <a href="assets/img/gallery/gallery-7.jpg" title="Gallery 7"
                                    class="glightbox preview-link"><i class="bi bi-arrows-angle-expand"></i></a>
                                <a href="gallery-single.html" class="details-link"><i class="bi bi-link-45deg"></i></a>
                            </div>
                        </div>
                    </div><!-- End Gallery Item -->

                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="gallery-item h-100">
                            <img src="assets/img/gallery/gallery-8-2.jpg" class="img-fluid" alt="">
                            <div class="gallery-links d-flex align-items-center justify-content-center">
                                <a href="assets/img/gallery/gallery-8-2.jpg" title="Gallery 8"
                                    class="glightbox preview-link"><i class="bi bi-arrows-angle-expand"></i></a>
                                <a href="gallery-single.html" class="details-link"><i class="bi bi-link-45deg"></i></a>
                            </div>
                        </div>
                    </div><!-- End Gallery Item -->

                </div>

            </div>

        </section><!-- /Gallery Section -->

    </main>

@endsection
