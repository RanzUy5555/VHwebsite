<footer class="mt-auto bg-primary">
    <div class="container">
        <div class="row">

            <div class="col-md-4 pt-5">
                <h2 class="h2 text-success border-bottom pb-3 border-secondary logo">
                    <img class="img-fluid rounded-circle" src="{{ asset('img/logo/logo.png') }}" width="200"
                        alt="logo">
                </h2>
                <ul class="list-unstyled text-white footer-link-list">
                    <li class="text-white">
                        <i class="fas fa-map-marker-alt"></i>
                        Manila East Road Hi-way Paete, Laguna, Philippines
                    </li>
                    <li>
                        <i class="fa fa-phone"></i>
                        <a class="text-decoration-none text-white" href="tel:+639268854582">+639268854582</a>
                    </li>
                    <li>
                        <i class="fa fa-envelope"></i>
                        <a class="text-decoration-none text-white" href="mailto: {{ config('app.mail_from_address') }}">
                            {{ config('app.mail_from_address') }}</a>
                    </li>
                </ul>
            </div>

            <div class="col-md-4 pt-5">
                <h2 class="h2 text-white border-bottom pb-3 border-secondary">Services</h2>
                <ul class="list-unstyled footer-link-list">
                    @foreach ($available_services as $service)
                        <li>
                            <span class="text-white">
                                {{ $service->name }}
                            </span>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="col-md-4 pt-5">
                <h2 class="h2 text-white border-bottom pb-3 border-secondary">Quick Links</h2>
                <ul class="list-unstyled text-white footer-link-list">
                    <li><a class="text-decoration-none text-white" href="/">Home</a></li>
                    <li><a class="text-decoration-none text-white" href="{{ route('main.about') }}">About Us</a>
                    </li>
                    <li><a class="text-decoration-none text-white"
                            href="{{ route('main.products.index') }}">Products</a>
                    </li>
                    <li><a class="text-decoration-none text-white" href="{{ route('user.requests.create') }}">Request a
                            Quotation</a></li>
                    <li><a class="text-decoration-none text-white" href="/#contact">Contact</a></li>
                    {{-- <li><a class="text-decoration-none text-white" href="/">Terms &amp;
                            Conditions</a></li>
                    <li><a class="text-decoration-none text-white" href="/">Privacy &amp;
                            Policy</a></li> --}}
                </ul>
            </div>

        </div>

        <div class="row text-white mb-4">
            <div class="col-12 mb-3">
                <div class="w-100 my-3 border-top border-secondary"></div>
            </div>
            <div class="col-auto mr-auto">
                <ul class="list-inline text-left footer-icons">
                    <li class="list-inline-item border border-secondary rounded-circle text-center">
                        <a class="text-white text-decoration-none" target="_blank"
                            href="https://www.facebook.com/VirgilioHandicraft"><i
                                class="fab fa-facebook-f fa-lg fa-fw"></i></a>
                    </li>
                    <li class="list-inline-item border border-secondary rounded-circle text-center">
                        <a class="text-white text-decoration-none" target="_blank" href="https://twitter.com/"><i
                                class="fab fa-twitter fa-lg fa-fw"></i></a>
                    </li>
                    <li class="list-inline-item border border-secondary rounded-circle text-center">
                        <a class="text-white text-decoration-none" target="_blank" href="https://www.instagram.com/"><i
                                class="fab fa-instagram fa-lg fa-fw"></i></a>
                    </li>
                    <li class="list-inline-item border border-secondary rounded-circle text-center">
                        <a class="text-white text-decoration-none" target="_blank" href="https://www.youtube.com/"><i
                                class="fab fa-youtube fa-lg fa-fw"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="w-100 bg-black py-3">
        <div class="container">
            <div class="row pt-2">
                <div class="col-12">
                    <p class="text-left text-white">
                        Copyright © 2024 {{ config('app.name') }}
                    </p>
                </div>
            </div>
        </div>
    </div>

</footer>
