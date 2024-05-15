@extends('layouts.admin.app')

@section('title', 'Admin | Request Info')

@section('content')

    {{-- CONTAINER --}}
    <div class="container-fluid py-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.requests.index') }}">All
                        Requests
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    #{{ $request->id }} - {{ $request->user->full_name }} - {{ $request->service->name }}
                </li>
            </ol>
        </nav>
        <div class="row justify-content-center">
            <div class="col-md-12 d-flex align-self-stretch">
                <div class="card w-100">
                    <div class="card-body d-flex and flex-column">
                        <img class="img-fluid rounded-circle" src="{{ handleNullAvatar($request->user?->avatar_profile) }}"
                            width="100" alt="avatar">
                        <br>
                        <h3 class="font-weight-normal">Customer: {{ $request->user->full_name }}</h3>
                        <h3 class="font-weight-normal">Email:
                            <a class="text-primary text-underline"
                                href="mailto:{{ $request->user->email }}">{{ $request->user->email }}</a>
                        </h3>
                        <h3 class="font-weight-normal">Company: {{ $request->company ?? 'N/A' }}</h3>
                        <h3 class="font-weight-normal">Selected Service: {{ $request->service->name }}</h3>
                        <h3 class="font-weight-normal">Message: {{ $request->message }}</h3>
                        <h3 class="font-weight-normal">Target Date: {{ formatDate($request->target_date) }}</h3>
                        <h3 class="font-weight-normal"> File Link:
                            <a class="text-primary text-underline" href="{{ $request->file_link }}"
                                target="_blank">{{ $request->file_link ?? 'N/A' }}</a>
                        </h3>
                        <h3 class="font-weight-normal">Date Requested: {{ formatDate($request->created_at) }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- End CONTAINER --}}

@endsection
