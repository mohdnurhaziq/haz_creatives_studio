@extends('layouts.template')

@section('title', 'Haz Creatives Studio - Home')

@push('styles')
    <link href="{{ asset('assets/vendor/typed.js/typed.css') }}" rel="stylesheet">
@endpush

@section('content')
    <!-- ======= Hero Section ======= -->
    <section id="hero" class="hero d-flex flex-column justify-content-center align-items-center" data-aos="fade">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 text-center">
                    <h2>We're <span>Haz Creatives Studio,</span> a Team of Professional Photographer from Kuching, Sarawak
                    </h2>
                    <p>Blanditiis praesentium aliquam illum tempore incidunt debitis dolorem magni est deserunt sed qui
                        libero. Qui voluptas amet.</p>
                    <a href="{{ route('contact') }}" class="btn-get-started">Available for hire</a>
                </div>
            </div>
        </div>
    </section>

    <main id="main" data-aos="fade" data-aos-delay="1500">
        <!-- ======= Gallery Section ======= -->
        <section id="gallery" class="gallery">
            <div class="container-fluid">
                <div class="row gy-4 justify-content-center">
                    @for ($i = 1; $i <= 8; $i++)
                        <div class="col-xl-3 col-lg-4 col-md-6">
                            <div class="gallery-item h-100">
                                <img src="{{ asset('assets/img/gallery/gallery-' . $i . '.jpg') }}" class="img-fluid"
                                    alt="">
                                <div class="gallery-links d-flex align-items-center justify-content-center">
                                    <a href="{{ asset('assets/img/gallery/gallery-' . $i . '.jpg') }}"
                                        title="Gallery {{ $i }}" class="glightbox preview-link"><i
                                            class="bi bi-arrows-angle-expand"></i></a>
                                    <a href="{{ route('gallery') }}" class="details-link"><i
                                            class="bi bi-link-45deg"></i></a>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </section>
    </main>
@endsection

@push('scripts')
    <script src="{{ asset('assets/vendor/typed.js/typed.umd.js') }}"></script>
    <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({
                duration: 1000,
                easing: 'ease-in-out',
                once: true,
                mirror: false
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            /**
             * Init swiper slider with 3 slides at once in desktop view
             */
            new Swiper('.slides-3', {
                speed: 600,
                loop: true,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false
                },
                slidesPerView: 'auto',
                pagination: {
                    el: '.swiper-pagination',
                    type: 'bullets',
                    clickable: true
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                breakpoints: {
                    320: {
                        slidesPerView: 1,
                        spaceBetween: 40
                    },
                    1200: {
                        slidesPerView: 3,
                    }
                }
            });
        });
    </script>
@endpush
