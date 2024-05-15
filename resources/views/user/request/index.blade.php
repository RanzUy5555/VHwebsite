@extends('layouts.user.app')

@section('title', 'Virgilio Handicraft | Request Quotation')

@section('styles')
    <link href="{{ asset('assets/css/utils/datatables.bootstrap4.min.css') }}" rel="stylesheet" /> {{-- DataTables --}}
    <link href="{{ asset('assets/css/utils/datatables.rowReorder.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/utils/datatables.responsive.min.css') }}" rel="stylesheet" />

    <style>
        td {
            word-wrap: break-word;
            word-break: break-all;
            white-space: normal !important;
            text-align: justify;
        }
    </style>

@endsection

@section('content')

    {{-- CONTAINER --}}
    <div class="container-fluid py-4">
        @include('layouts.includes.alert')
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <a class="float-right btn btn-sm btn-primary me-3"
                            href="{{ route('user.requests.create') }}">Request
                            Quotation +</a><br><br>
                        <div class="table-responsive">
                            <table class="table table-flush table-hover request_dt">
                                <caption>List of Requested Quotation</caption>
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Service</th>
                                        <th>Message</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- Display Requests --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- End CONTAINER --}}

@endsection

@section('script')
    <script src="{{ asset('assets/js/utils/datatables.min.js') }}"></script> {{-- DT --}}
    <script src="{{ asset('assets/js/utils/datatables.rowReorder.min.js') }}"></script>
    <script src="{{ asset('assets/js/utils/datatables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/js/utils/datatables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/js/utils/datatables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/js/shared/crud.js') }}"></script>
@endsection
