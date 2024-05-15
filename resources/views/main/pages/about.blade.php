@extends('layouts.main.app')

@section('title', 'Virgilio Handicraft | About Us')

@section('styles')
    <style>
        .py-5 {
            padding-top: 3rem !important;
            padding-bottom: 3rem !important;
        }

        .pt-5 {
            padding-top: 3rem !important;
        }

        .my-5 {
            margin-top: 3rem !important;
            margin-bottom: 3rem !important;
        }

        .border-0 {
            border: 0 !important;
        }

        .position-relative {
            position: relative !important;
        }

        .shadow-lg {
            box-shadow: 0 1rem 3rem rgb(0 0 0 / 18%) !important;
        }

        .card {
            position: relative;
            display: -webkit-flex;
            display: flex;
            -webkit-flex-direction: column;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid rgba(0, 0, 0, 0.125);
            border-radius: .25rem;
        }

        .member-profile {
            top: -50px;
            left: 0;
        }

        .text-center {
            text-align: center !important;
        }

        .w-100 {
            width: 100% !important;
        }

        .position-absolute {
            position: absolute !important;
        }

        .member-profile img {
            width: 100px;
            height: 100px;
        }

        .rounded-circle {
            border-radius: 50% !important;
        }

        .mx-auto {
            margin-right: auto !important;
            margin-left: auto !important;
        }

        .shadow-sm {
            box-shadow: 0 0.125rem 0.25rem rgb(0 0 0 / 8%) !important;
        }

        .team-pics {
            border: 2px solid #B77729 !important;
        }
    </style>
@endsection

@section('content')
    <!-- Page content -->
    <div class="container pb-5 mt-5 mt-lg-6">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center">
                <img class="img-fluid d-block mx-auto" src="{{ asset('img/about/about-us.svg') }}" alt="about-us">

                <h2 class="gradient-text font-weight-normal">
                    Welcome to Virgilio Handicrafts, where timeless craftsmanship meets spiritual devotion. Located along
                    Manila East Road Hi-way in Paete, Philippines, our workshop stands as a beacon of tradition and artistry
                    in the heart of this historic town.

                    At Virgilio Handicrafts, we specialize in crafting exquisite Christian sculptures, each piece
                    meticulously sculpted by skilled artisans. With a passion for preserving heritage and a commitment to
                    quality, we take pride in creating handcrafted masterpieces that reflect the essence of faith and
                    spirituality.

                    Our journey began with a vision to honor the rich cultural heritage of Paete, renowned for its tradition
                    of wood carving. Drawing inspiration from centuries-old techniques and imbued with a spirit of
                    reverence, our sculptures capture the beauty and depth of Christian symbolism.

                    As a testament to our dedication to the craft, we offer custom sculpture services, allowing our clients
                    to bring their unique visions to life. Whether it's a cherished religious figure or a bespoke creation,
                    we work closely with our clients to ensure their vision is realized with precision and care.

                    Beyond crafting sculptures, we also offer restoration and preservation services, breathing new life into
                    antique pieces and safeguarding their legacy for future generations.

                    At Virgilio Handicrafts, we invite you to explore our gallery of handcrafted treasures and experience
                    the artistry and devotion that define our work. Join us on a journey of faith, tradition, and
                    craftsmanship, as we continue to sculpt stories of reverence and inspiration.

                    Visit us at Manila East Road Hi-way, Paete, Philippines, and discover the beauty of Christian artistry
                    with Virgilio Handicrafts.
                </h2>

            </div>
        </div>

    </div>
@endsection
