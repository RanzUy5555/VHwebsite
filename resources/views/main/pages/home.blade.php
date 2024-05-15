@extends('layouts.main.app')

@section('styles')
    <style>
        .animated {
            max-width: 600px;
        }

        #hero:before {
            content: "";
            background: #B77729;
            position: absolute;
            bottom: 0;
            top: 0;
            left: 0;
            right: 0;
        }

        @media (min-width: 1024px) {
            #hero {
                background-attachment: fixed;
            }
        }


        #hero {
            width: 100%;
            background: url({{ asset('img/main/section-1/hero-bg.jpg') }});
            position: relative;
            padding: 120px 0 0 0;
        }

        #hero .animated {
            animation: up-down 2s ease-in-out infinite alternate-reverse both !important;
        }

        section {
            padding: 60px 0;
            overflow: hidden;
        }

        #hero h1 {
            margin: 0 0 20px 0;
            font-size: 48px;
            font-weight: 700;
            line-height: 56px;
            color: rgba(255, 255, 255, 0.8);
        }

        #hero h1 span {
            color: #fff;
            border-bottom: 4px solid #a86410;
        }

        #hero h2 {
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 40px;
            font-size: 24px;
        }


        @-webkit-keyframes up-down {
            0% {
                transform: translateY(10px);
            }

            100% {
                transform: translateY(-10px);
            }
        }

        @keyframes up-down {
            0% {
                transform: translateY(10px);
            }

            100% {
                transform: translateY(-10px);
            }
        }

        .hero-waves {
            display: block;
            margin-top: 60px;
            width: 100%;
            height: 60px;
            z-index: 5;
            position: relative;
        }

        .wave1 use {
            -webkit-animation: move-forever1 10s linear infinite;
            animation: move-forever1 10s linear infinite;
            -webkit-animation-delay: -2s;
            animation-delay: -2s;
        }

        .wave2 use {
            -webkit-animation: move-forever2 8s linear infinite;
            animation: move-forever2 8s linear infinite;
            -webkit-animation-delay: -2s;
            animation-delay: -2s;
        }

        .wave3 use {
            -webkit-animation: move-forever3 6s linear infinite;
            animation: move-forever3 6s linear infinite;
            -webkit-animation-delay: -2s;
            animation-delay: -2s;
        }

        @-webkit-keyframes move-forever1 {
            0% {
                transform: translate(85px, 0%);
            }

            100% {
                transform: translate(-90px, 0%);
            }
        }

        @keyframes move-forever1 {
            0% {
                transform: translate(85px, 0%);
            }

            100% {
                transform: translate(-90px, 0%);
            }
        }

        @-webkit-keyframes move-forever2 {
            0% {
                transform: translate(-90px, 0%);
            }

            100% {
                transform: translate(85px, 0%);
            }
        }

        @keyframes move-forever2 {
            0% {
                transform: translate(-90px, 0%);
            }

            100% {
                transform: translate(85px, 0%);
            }
        }

        @-webkit-keyframes move-forever3 {
            0% {
                transform: translate(-90px, 0%);
            }

            100% {
                transform: translate(85px, 0%);
            }
        }

        @keyframes move-forever3 {
            0% {
                transform: translate(-90px, 0%);
            }

            100% {
                transform: translate(85px, 0%);
            }
        }


        #hero .btn-get-started {
            font-family: "Montserrat", sans-serif;
            font-weight: 500;
            font-size: 16px;
            letter-spacing: 1px;
            display: inline-block;
            padding: 10px 30px;
            border-radius: 50px;
            transition: 0.5s;
            color: #5C4BB3;
            background: #fff;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: "Montserrat", sans-serif !important;
        }

        .fixed-image-size {
            width: 450px;
            /* Set your desired width */
            height: 250px;
            /* Set your desired height */
            object-fit: cover;
            /* Maintain aspect ratio while filling the container */
        }
    </style>
@endsection

@section('content')
    {{-- Section 1 --}}
    <section id="hero">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-7 pt-0 pt-md-5 pt-lg-0 order-2 order-lg-1 d-flex align-items-center">
                    <div data-aos="zoom-out" class="aos-init aos-animate">
                        <h1>Capturing the Spirit of Devotion in Every Sculpture at <span> Virgilio Handicraft <i
                                    class="fas fa-stamp ml-1"></i></span>
                        </h1>
                        <h2 class="font-weight-normal">
                            From skilled hands to devout hearts, each sculpture embodies a testament of faith. Sculpting
                            Stories of Faith, Each Chisel Carving Devotion into Timeless Icons.
                        </h2>
                        <div class="text-center text-lg-left">
                            <a href="{{ route('auth.login') }}" class="btn-get-started scrollto">Get in Touch </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 order-1 order-lg-2 hero-img aos-init aos-animate w-100 d-none d-md-block"
                    data-aos="zoom-out" data-aos-delay="300">

                    <img src="{{ asset('img/main/section-1/design.jpg') }}" class="img-fluid animated" alt="main">

                </div>
            </div>
        </div> <svg class="hero-waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
            viewBox="0 24 150 28 " preserveAspectRatio="none">
            <defs>
                <path id="wave-path" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z"> </path>
            </defs>
            <g class="wave1">
                <use xlink:href="#wave-path" x="50" y="3" fill="rgba(255,255,255, .1)"> </use>
            </g>
            <g class="wave2">
                <use xlink:href="#wave-path" x="50" y="0" fill="rgba(255,255,255, .2)"> </use>
            </g>
            <g class="wave3">
                <use xlink:href="#wave-path" x="50" y="9" fill="#fff"> </use>
            </g>
        </svg>
    </section>
    {{-- End Section 1 --}}

    {{-- Section 2 --}}
    <section class="bg-white py-2 py-md-5">
        <div class="container">
            <div class="row text-center pt-3">
                <div class="col-lg-6 m-auto">
                    <h1 class="d-md-block text-primary font-weight-normal"> Our Services
                    </h1>
                    <p>
                        Set your business up for success with quality prints that make your name and brand stand out!
                    </p>
                </div>
            </div>
            <div class="row">

                @foreach ($available_services as $service)
                    <div class="col-md-4 d-flex services align-self-stretch p-4">
                        <div class="media block-6 d-block text-center">
                            <div>
                                <img class="img-fluid d-block mx-auto rounded fixed-image-size"
                                    src="{{ handleNullFeaturedPhoto($service->featured_photo) }}" alt="service">
                            </div>
                            <div class="media-body p-2 mt-3">
                                <h3 class="font-weight-normal">{{ $service->name }}</h3>
                                <h4 class="font-weight-normal text-muted">{{ textTruncate($service->description) }}</h4>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <center>
            <hr class="w-75">
        </center>
    </section>
    {{-- End Section 2 --}}



    {{-- Section 3 --}}
    {{-- <section class="bg-white py-2 py-md-5">
        <div class="container">
            <div class="row text-center pt-3">
                <div class="col-lg-6 m-auto">
                    <h1 class="d-md-block text-primary font-weight-normal"> Why Us?
                    </h1>
                    <p>
                        We differentiate ourselves from the competition by
                        providing value to our customers. We take pride in being the partner, for your business
                        requirements offering a winning blend of expertise personalized service, notch quality and
                        customer satisfaction.
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 d-flex services align-self-stretch p-4 ftco-animate fadeInUp ftco-animated">
                    <div class="media block-6 d-block text-center">
                        <div>
                            <img class="img-fluid d-block mx-auto rounded" src="{{ asset('img/main/section-3/1.png') }}"
                                alt="image_one">
                        </div>
                        <div class="media-body p-2 mt-3">
                            <h3 class="text-primary font-weight-normal">We are fully online based</h3>
                            <h4 class="font-weight-normal text-muted">Our online presence showcases full product lineup,
                                published prices, online design, and guide to general queries and way to reach to us.</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 d-flex services align-self-stretch p-4 ftco-animate fadeInUp ftco-animated">
                    <div class="media block-6 d-block text-center">
                        <div>
                            <img class="img-fluid d-block mx-auto rounded" src="{{ asset('img/main/section-3/2.png') }}"
                                alt="image_two">
                        </div>
                        <div class="media-body p-2 mt-3">
                            <h3 class="text-primary font-weight-normal">We are bilingual</h3>
                            <h4 class="font-weight-normal text-muted">Our customer care team is fully bilingual and ready to
                                assist you with any level of queries regarding order, delivery or production guide.</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 d-flex services align-self-stretch p-4 ftco-animate fadeInUp ftco-animated">
                    <div class="media block-6 d-block text-center">
                        <div>
                            <img class="img-fluid d-block mx-auto rounded" src="{{ asset('img/main/section-3/3.png') }}"
                                alt="image_three">
                        </div>
                        <div class="media-body p-2 mt-3">
                            <h3 class="text-primary font-weight-normal">We provide 100% satisfaction</h3>
                            <h4 class="font-weight-normal text-muted">Customer satisfaction is a prime concern of our
                                business. Thus, our services are our best sales point, and we deliver the same to our
                                clients.</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <center>
            <hr class="w-75">
        </center>
    </section> --}}
    {{-- End Section 3 --}}

    {{-- Section Request Qoute --}}
    <section class="bg-primary text-white">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-md-10">
                    <p>
                        Do you have a custom project in mind? We offer FREE quotation to our customers.
                        <a href="{{ route('user.requests.create') }}" class="btn btn-lg btn-outline-white ml-3"
                            id="request_quote">
                            REQUEST A QUOTATION +
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </section>
    {{-- Section Request Qoute --}}



    {{-- Section 4 --}}
    <section class="bg-white" id="contact">
        <div class="container">
            <div class="row">
                <div class="col-md-6 pr-md-5 aside-stretch py-5 choose d-none d-md-block">
                    <img class="img-fluid" src="{{ asset('img/main/section-4/contact.svg') }}" alt="contact">
                </div>
                <div class="col-md-6 py-0 py-md-5 pl-md-5">
                    <h1 class="mb-2 font-weight-normal text-primary">Connect with Us <i class="fa fa-phone ml-1"
                            aria-hidden="true"></i></h1>
                    <p>
                        Need help? Our team got you covered on your concerns or questions in mind.
                    </p>
                    @include('layouts.includes.alert')
                    <br>
                    <form action="{{ route('main.contacts.store') }}" class="ftco-animate fadeInUp ftco-animated"
                        method="POST">

                        @csrf


                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Full Name" name="name"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="email" class="form-control" placeholder="Email" name="email" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="number" min="0" class="form-control" placeholder="Phone"
                                        name="contact" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <textarea name="message" cols="30" rows="7" class="form-control" placeholder="Message" required
                                        spellcheck="false"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary py-3 px-5">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    {{-- Section 4 --}}

    {{-- Section 5 --}}
    <section class="py-0">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3865.0834028614972!2d121.47677962290038!3d14.364585232001728!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397fa9b20bbcf97%3A0x46984b1bdf94e32e!2sR-5%2C%20Paete%2C%20Laguna!5e0!3m2!1sen!2sph!4v1711005419441!5m2!1sen!2sph"
            width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
    </section>
    {{-- Section 5 --}}
@endsection
