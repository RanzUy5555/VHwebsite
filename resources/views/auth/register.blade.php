@extends('layouts.main.app')

@section('title', 'Virgilio Handicraft | Register')

@section('content')
    <div class="container ">
        <div class="row gx-lg-5 align-items-center d-flex align-items-center vh-100">
            <div class="col-lg-6 mb-5 mb-lg-0 mt-5 mt-lg-0">
                <h1 class="display-3 font-weight-bold ls-tight">
                    <span class="text-primary">{{ config('app.name') }}</span>
                </h1>
                <p style="color: hsl(217, 10%, 50.8%)">
                    Welcome to Virgilio Handicraft! To get started, simply fill out the registration form and create
                    your account. Once you've done that, you'll have access to our full range of products, pricing, and
                    special promotions. Plus, you'll be able to manage your orders, track orders, and much more.
                </p>
                <img class="img-fluid d-none d-lg-block" src="{{ asset('img/auth/register.svg') }}" alt="">
            </div>

            <div class="col-lg-6 mb-5 mb-lg-0">
                <div class="card">
                    <div class="card-body py-5 px-md-5">
                        <form action="{{ route('auth.attempt_register') }}" method="post">
                            @csrf
                            @include('layouts.includes.alert')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-outline mb-2">
                                        <label class="form-label">First Name</label>
                                        <input class="form-control" type="text" name="first_name"
                                            value="{{ old('first_name') }}">
                                    </div>
                                    <div class="form-outline mb-2">
                                        <label class="form-label">Middle Name</label>
                                        <input class="form-control" type="text" name="middle_name"
                                            value="{{ old('middle_name') }}">
                                    </div>
                                    <div class="form-outline mb-2">
                                        <label class="form-label">Last Name</label>
                                        <input class="form-control" type="text" name="last_name"
                                            value="{{ old('last_name') }}">
                                    </div>
                                    <div class="form-outline mb-2">
                                        <label class="form-label">Gender</label>
                                        <select class="form-control" name="gender">
                                            <option value=""></option>
                                            <option value="male" @if (old('gender') == 'male') selected @endif>Male
                                            </option>
                                            <option value="female" @if (old('gender') == 'female') selected @endif>Female
                                            </option>
                                        </select>
                                    </div>
                                    <div class="form-outline mb-2">
                                        <label class="form-label">Birth Date</label>
                                        <input class="form-control" type="date" max="2012-01-01" name="birth_date"
                                            value="{{ formatDate(old('birth_date'), 'dateInput') }}">
                                    </div>
                                    <div class="form-outline mb-2">
                                        <label class="form-label">Address</label>
                                        <input class="form-control" type="text"name="address"
                                            placeholder="Complete Address" value="{{ old('address') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-outline mb-2">
                                        <label class="form-label">Municipality</label>
                                        <select class="form-control" name="municipality_id">
                                            <option value=""></option>
                                            @foreach ($municipalities as $id => $municipality)
                                                <option value="{{ $id }}"
                                                    @if (old('municipality_id') == $id) selected @endif>{{ $municipality }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-outline mb-2">
                                        <label class="form-label">Contact</label>
                                        <input class="form-control" type="number" min="0" name="contact"
                                            placeholder="Ex. 09659312005" value="{{ old('contact') }}">
                                    </div>
                                    <div class="form-outline mb-2">
                                        <label class="form-label">Email</label>
                                        <input class="form-control" type="email" name="email"
                                            placeholder="you@email.com" value="{{ old('email') }}">
                                    </div>

                                    <div class="form-outline mb-2">
                                        <label class="form-label">Password</label>
                                        <input type="password" class="form-control" name="password">
                                    </div>
                                    <div class="form-outline mb-2">
                                        <label class="form-label">Re-Type Password</label>
                                        <input type="password" class="form-control" name="password_confirmation">
                                    </div>
                                </div>
                            </div>
                            <br>
                            <!-- Checkbox -->
                            <div class="form-check  mb-4 text-center">
                                <input class="form-check-input mr-2" type="checkbox" name="terms_of_service" id="tos"
                                    checked>
                                <label class="form-check-label text-sm" for="tos">
                                    I have read the Terms of Service
                                </label>
                            </div>

                            <!-- Submit button -->
                            <button type="submit" class="btn btn-primary btn-block mb-4">
                                Sign up
                            </button>

                            {{-- <h5 class="text-center font-weight-normal text-muted">or login with</h5>
                            <div class="row g-2 mb-3">
                                <div class="col-sm-6"><a class="btn btn-outline-primary btn-sm d-block w-100"
                                        href="https://dvocapstoneprojectmaker.mainsandbox.com/login/github"><span
                                            class="fab fa-facebook mr-2" data-fa-transform="grow-8"></span>
                                        Facebook</a>
                                </div>

                                <div class="col-sm-6"><a class="btn btn-outline-danger btn-sm d-block w-100"
                                        href="{{ route('auth.login_with_app', 'google') }}"><span
                                            class="fab fa-google-plus-g mr-2" data-fa-transform="grow-8"></span>
                                        Google</a>
                                </div>
                            </div> --}}
                            <div class="text-center">
                                <a class="text-sm" href="{{ route('auth.login') }}">Already have an account?</a>
                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('#main_register_nav').addClass('active')
    </script>
@endsection
