@extends('layouts.user.app')

@section('title', 'Virgilio Handicraft | Request Quotation')

@section('content')

    {{-- CONTAINER --}}
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h2 class="font-weight-normal text-primary">
                            <a class="text-primary float-left" href="{{ route('user.requests.index') }}">
                                <i class='fas fa-arrow-left'></i>
                            </a>
                            <span class="ml-3"> Edit Requested Quotation <i class="fas fa-edit ml-1"></i></span>
                        </h2>
                        <div class="row">
                            <div class="col-md-8">
                                <br>
                                @include('layouts.includes.alert')
                                <form class="row" action="{{ route('user.requests.update', $request) }}" method="post"
                                    id="request_form">
                                    @csrf @method('PUT')
                                    <div class="col-md-10">

                                        <div class="form-group">
                                            <label class="form-label">Name </label>
                                            <input type="text" class="form-control"
                                                value="{{ auth()->user()->full_name }}" readonly>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">Contact </label>
                                            <input type="text" class="form-control" value="{{ auth()->user()->contact }}"
                                                readonly>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">Company </label>
                                            <input type="text" class="form-control" name="company"
                                                value="{{ $request->company }}" required>
                                        </div>


                                        <div class="form-group">
                                            <label class="form-label">Which services are you interested in? *</label>
                                            <select class="form-control" name="service_id" required>
                                                <option value=""></option>
                                                @foreach ($services as $id => $service)
                                                    <option value="{{ $id }}"
                                                        @if ($request->service_id == $id) selected @endif>
                                                        {{ $service }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">Tell us about your product requirements and
                                                specifications. *</label>
                                            <textarea class="form-control" name="message" rows="5"
                                                placeholder="What to customize, type of material, quantity, etc.">{{ $request->message }}</textarea>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">Enter Google Drive Link or File URL </label>
                                            <input type="url" class="form-control" name="file_link"
                                                value="{{ $request->file_link }}" required>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">Target Delivery Date * </label>
                                            <input type="date" class="form-control" name="target_date"
                                                value="{{ formatDate($request->target_date, 'dateInput') }}" required>
                                        </div>


                                        <div class="form-group">
                                            <button type="button" class="btn btn-primary"
                                                onclick="promptUpdate(event, '#request_form')">Save</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-4">
                                <img class="img-fluid" src="{{ asset('img/request/default.svg') }}"
                                    alt="request a quotation">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- End CONTAINER --}}

@endsection
