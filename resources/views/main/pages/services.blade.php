@extends('layouts.main.app')

@section('title', 'Virgilio Handicraft | Services')

@section('styles')
    <style>
        .card-img-top {
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
    <!-- Page content -->
    <div class="container pb-5 mt-5 ">

        {{-- Section Request Qoute --}}
        <section class=" text-primary">
            <div class="container">
                <div class="row justify-content-center text-center">
                    <div class="col-md-10">
                        <br>
                        <p>
                            Do you have a custom project in mind? We offer FREE quotation to our customers.

                        </p>
                    </div>
                </div>
            </div>
        </section>
        {{-- Section Request Qoute --}}

        <div class="row justify-content-center">
            @foreach ($available_services as $service)
                <div class="col-md-4 d-flex services align-self-stretch p-4">
                    <div class="card">
                        <img class="card-img-top d-block mx-auto rounded fixed-image-size"
                            src="{{ handleNullFeaturedPhoto($service->featured_photo) }}" alt="service">
                        <div class="card-body">
                            <h3 class="font-weight-normal">{{ $service->name }}</h3>
                            <h4 class="font-weight-normal text-muted">{{ textTruncate($service->description, 500) }}</h4>
                        </div>
                    </div>
                    {{-- <div class="media block-6 d-block text-center">
                <div>
                    <img class="img-fluid d-block mx-auto rounded fixed-image-size"
                        src="{{ handleNullFeaturedPhoto($service->featured_photo) }}" alt="service">
                </div>
                <div class="media-body p-2 mt-3">
                    <h3 class="font-weight-normal">{{ $service->name }}</h3>
                    <h4 class="font-weight-normal text-muted">{{ textTruncate($service->description) }}</h4>
                </div>
            </div> --}}
                </div>
            @endforeach
        </div>
        <div class="row justify-content-center text-center">
            <div class="col-md-10">
                <br>
                <p>
                    <a href="{{ route('user.requests.create') }}" class="btn btn-lg btn-primary ml-3" id="request_quote">
                        Click to REQUEST A QUOTATION +
                    </a>
                </p>
            </div>
        </div>


    </div>
@endsection
