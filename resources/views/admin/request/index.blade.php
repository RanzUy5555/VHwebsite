@extends('layouts.admin.app')

@section('title', 'Admin | Requested Quotation')

@section('styles')

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
                        <div class="table-responsive">
                            <table class="table table-flush table-hover request_dt">
                                <caption>List of Requested Quotation</caption>
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Customer</th>
                                        <th>Service / Subject</th>
                                        <th>Message</th>
                                        <th>Target Date</th>
                                        <th>Link</th>
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
