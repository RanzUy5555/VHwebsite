@extends('layouts.admin.app')

@section('title', 'Admin | Create Service')

@section('content')

    {{-- CONTAINER --}}
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h2 class="font-weight-normal text-primary">
                            <a class="text-primary float-left" href="{{ route('admin.services.index') }}">
                                <i class='fas fa-arrow-left'></i>
                            </a>
                            <span class="ml-3"> Create Service <i class="fas fa-plus-circle ml-1"></i></span>
                        </h2>
                        <div class="row">
                            <div class="col-md-8">
                                <br>
                                @include('layouts.includes.alert')
                                <form class="row" action="{{ route('admin.services.store') }}" method="post"
                                    id="service_form">
                                    @csrf
                                    <div class="col-md-10">
                                        <div class="form-group mb-2">
                                            <label class="form-label">Service *</label>
                                            <input type="text" class="form-control" name="name" required>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="form-label">Description *</label>
                                            <textarea class="form-control" name="description" rows="5" placeholder="Add description about the service"></textarea>
                                        </div>

                                        <div>
                                            <input type="file" class="service_image" name="image">
                                        </div>


                                        <div class="form-group">
                                            <button type="button" class="btn btn-primary"
                                                onclick="promptStore(event, '#service_form')">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-4">
                                <img class="img-fluid" src="{{ asset('img/crud/default.svg') }}" alt="manage">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- End CONTAINER --}}

@endsection

@section('script')
    <script>
        initiateFilePond('.service_image')
    </script>
@endsection
