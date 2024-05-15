@extends('layouts.admin.app')

@section('title', 'Admin | Manage Brand')

@section('content')

    {{-- CONTAINER --}}
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <a class="float-right btn btn-sm btn-primary me-3" href="javascript:void(0)"
                            onclick="toggle_modal('#m_brand', '.brand_form', ['#m_brand_title','Add brand'], ['.btn_add_brand','.btn_update_brand'])">Create
                            Brand +</a><br><br>
                        <div class="table-responsive">
                            <table class="table table-flush table-hover brand_dt">
                                <caption>List of Brand</caption>
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Brand</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- Display Brands --}}
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
