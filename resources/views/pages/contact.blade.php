@extends('layouts.template')

@section('title', 'Haz Creatives Studio - Contact')

@push('styles')
    <link href="{{ asset('assets/vendor/typed.js/typed.css') }}" rel="stylesheet">
    <style>
        .message-box {
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
            text-align: center;
            display: none;
        }

        .success-message {
            background: #059652;
            color: #fff;
        }

        .error-message {
            background: #dc3545;
            color: #fff;
        }
    </style>
@endpush

@section('content')

    <main class="main">

        <!-- Page Title -->
        <div class="page-title" data-aos="fade">
            <div class="heading">
                <div class="container">
                    <div class="row d-flex justify-content-center text-center">
                        <div class="col-lg-8">
                            <h1>Contact</h1>
                            <p class="mb-0">Get in touch with us. We'd love to hear from you!</p>
                        </div>
                    </div>
                </div>
            </div>
            <nav class="breadcrumbs">
                <div class="container">
                    <ol>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li class="current">Contact</li>
                    </ol>
                </div>
            </nav>
        </div><!-- End Page Title -->

        <!-- Contact Section -->
        <section id="contact" class="contact section">

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="info-wrap" data-aos="fade-up" data-aos-delay="200">
                    <div class="row gy-5">

                        <div class="col-lg-4">
                            <div class="info-item d-flex align-items-center">
                                <i class="bi bi-geo-alt flex-shrink-0"></i>
                                <div>
                                    <h3>Location</h3>
                                    <p>1st Floor, Lot 14106 SL. 131, Metro City, 3, Q309, Petra Jaya, 93050 Kuching, Sarawak
                                    </p>
                                </div>
                            </div>
                        </div><!-- End Info Item -->

                        <div class="col-lg-4">
                            <div class="info-item d-flex align-items-center">
                                <i class="bi bi-telephone flex-shrink-0"></i>
                                <div>
                                    <h3>Call</h3>
                                    <p>+60165767430</p>
                                </div>
                            </div>
                        </div><!-- End Info Item -->

                        <div class="col-lg-4">
                            <div class="info-item d-flex align-items-center">
                                <i class="bi bi-envelope flex-shrink-0"></i>
                                <div>
                                    <h3>Email</h3>
                                    <p>info@example.com</p>
                                </div>
                            </div>
                        </div><!-- End Info Item -->

                    </div>
                </div>

                <form id="contactForm" action="{{ route('contact.store') }}" method="POST" class="php-email-form"
                    data-aos="fade-up" data-aos-delay="300">
                    @csrf
                    <div class="row gy-4">
                        <div class="col-md-6">
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                placeholder="Your Name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                placeholder="Your Email" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-12">
                            <input type="text" name="subject" class="form-control @error('subject') is-invalid @enderror"
                                placeholder="Subject" value="{{ old('subject') }}" required>
                            @error('subject')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-12">
                            <textarea name="message" class="form-control @error('message') is-invalid @enderror" rows="6"
                                placeholder="Message" required>{{ old('message') }}</textarea>
                            @error('message')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-12 text-center">
                            <div id="formMessage" class="message-box"></div>
                            <button type="submit" class="btn btn-primary">Send Message</button>
                        </div>
                    </div>
                </form>

            </div>

        </section><!-- End Contact Section -->

    </main>

@endsection

@push('scripts')
    <script src="{{ asset('assets/vendor/typed.js/typed.umd.js') }}"></script>
    <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize AOS
            AOS.init({
                duration: 1000,
                easing: 'ease-in-out',
                once: true,
                mirror: false
            });

            const form = document.getElementById('contactForm');
            const formMessage = document.getElementById('formMessage');
            const submitButton = form.querySelector('button[type="submit"]');

            function showMessage(type, text) {
                formMessage.className = 'message-box ' + (type === 'success' ? 'success-message' : 'error-message');
                formMessage.textContent = text;
                formMessage.style.display = 'block';
                formMessage.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
            }

            form.addEventListener('submit', async function(e) {
                e.preventDefault();
                submitButton.disabled = true;
                formMessage.style.display = 'none';

                try {
                    const response = await fetch(form.action, {
                        method: 'POST',
                        body: new FormData(form),
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    });

                    const data = await response.json();
                    submitButton.disabled = false;

                    if (response.ok && data.success) {
                        form.reset();
                        showMessage('success', 'Thank you! Your message has been sent successfully.');
                    } else {
                        showMessage('error',
                            'Sorry, there was an error sending your message. Please try again.');
                    }
                } catch (error) {
                    console.error('Form submission error:', error);
                    submitButton.disabled = false;
                    showMessage('error',
                        'Sorry, there was an error sending your message. Please try again.');
                }
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
