<!-- Topbar Start -->
<div class="container-fluid">
    <div class="row bg-secondary py-1 px-xl-5">
        <div class="col-lg-6 d-none d-lg-block">
            <div class="d-inline-flex align-items-center h-100">
                <a class="text-body mr-3" href="">Apropos</a>
                <a class="text-body mr-3" href="">Contact</a>
                <a class="text-body mr-3" href="">Aide</a>
                <a class="text-body mr-3" href="">FAQs</a>
            </div>
        </div>
        <div class="col-lg-6 text-center text-lg-right">
            <div class="d-inline-flex align-items-center">
                <div class="btn-group">
                    @if(auth()->check() && auth()->user()->user_type == 2)
                        <a href="{{route('account')}}" type="button" class="btn btn-sm btn-light">Mon compte</a>
                    @else
                        <a href="{{route('logincustomer')}}" class="btn btn-sm btn-outline-success" type="button">Se connecter</a>
                        <a href="{{route('register')}}" class="btn btn-sm btn-outline-primary" type="button">S'inscrire</a>
                    @endif
                </div>
            </div>
            <div class="d-inline-flex align-items-center d-block d-lg-none">
                <a href="" class="btn px-0 ml-2">
                    <i class="fas fa-heart text-dark"></i>
                    <span class="badge text-dark border border-dark rounded-circle" style="padding-bottom: 2px;">0</span>
                </a>
                <a href="{{route('checkout')}}" class="btn px-0 ml-2">
                    <i class="fas fa-shopping-cart text-dark"></i>
                    @if(session('soin_id'))
                    <span class="badge text-dark border border-dark rounded-circle" style="padding-bottom: 2px;">1</span>
                    @else
                        <span class="badge text-dark border border-dark rounded-circle" style="padding-bottom: 2px;">0</span>
                    @endif
                </a>
            </div>
        </div>
    </div>
    <div class="row align-items-center bg-light py-3 px-xl-5 d-none d-lg-flex">
        <div class="col-lg-4">
            <a href="{{route('home')}}" class="text-decoration-none">
                <img src="{{ asset('logo.jpeg') }}" height="100">
                {{--<span class="h1 text-uppercase text-primary bg-dark px-2">STYL</span>
                <span class="h1 text-uppercase text-dark bg-primary px-2 ml-n1">ISTE</span>--}}
            </a>
        </div>
        <div class="col-lg-4 col-6 text-left">
            <form action="">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Recherche des soins">
                    <div class="input-group-append">
                            <span class="input-group-text bg-transparent text-primary">
                                <i class="fa fa-search"></i>
                            </span>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-lg-4 col-6 text-right">
            <p class="m-0">Service client</p>
            <h5 class="m-0">+012 345 6789</h5>
        </div>
    </div>
</div>
<!-- Topbar End -->
<!-- Navbar Start -->
<div class="container-fluid bg-dark mb-30">
    <div class="row px-xl-5">
        <div class="col-lg-12">
            <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-0">
                <a href="{{route('home')}}" class="text-decoration-none d-block d-lg-none">
                    <img src="{{ asset('logo.jpeg') }}">
                   {{-- <span class="h1 text-uppercase text-dark bg-light px-2">Stil</span>
                    <span class="h1 text-uppercase text-light bg-primary px-2 ml-n1">Iste</span>--}}
                </a>
                <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav mr-auto py-0">
                        <a href="{{route('home')}}" class="nav-item nav-link active">Home</a>
                        <a href="{{route('startreservation')}}" class="nav-item nav-link">Reserver</a>

                        <a href="{{route('contact')}}" class="nav-item nav-link">Contact</a>
                    </div>
                    <div class="navbar-nav ml-auto py-0 d-none d-lg-block">
                        <a href="" class="btn px-0">
                            <i class="fas fa-heart text-primary"></i>
                            <span class="badge text-secondary border border-secondary rounded-circle" style="padding-bottom: 2px;">0</span>
                        </a>
                        <a href="{{route('checkout')}}" class="btn px-0 ml-3">
                            <i class="fas fa-shopping-cart text-primary"></i>
                            @if(!is_null(session('soin_id')))
                            <span class="badge text-secondary border border-secondary rounded-circle" style="padding-bottom: 2px;">1</span>
                            @else
                                <span class="badge text-secondary border border-secondary rounded-circle" style="padding-bottom: 2px;">0</span>
                            @endif
                        </a>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>
<!-- Navbar End -->

{{--
<!-- Topbar Start -->
<div class="container-fluid bg-dark text-light p-0">
    <div class="row  d-none gx-0 d-lg-flex">
        <div class="col-lg-7 px-5 text-start">
            <div class="h-100 d-inline-flex align-items-center me-4">
                <small class="fas fa-map-marked text-primary me-2"></small>
                <small>Langer Steinweg 60, 32825 Blomberg</small>
            </div>
            <div class="h-100 d-inline-flex align-items-center me-4">
                <small class="far fa-clock text-primary me-2"></small>
                <small>Mon - Fri : 09.00 AM - 09.00 PM</small>
            </div>

            <div class="h-100 d-inline-flex align-items-center">
                <small class="fa fa-phone text-primary me-2"></small>
                <small> +43 1609 6205 012</small>
            </div>
        </div>
        <div class="col-lg-5 px-5 text-end">
            <div class="h-100 d-inline-flex align-items-center">

                <div class="dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#">
                        FR
                    </a>

                </div>

            </div>
            <div class="h-100 d-inline-flex align-items-center mx-n2">
                <a class="btn btn-square btn-link rounded-0 border-0 border-end border-secondary" href=""><i
                        class="fab fa-facebook-f"></i></a>
                <a class="btn btn-square btn-link rounded-0 border-0 border-end border-secondary" href=""><i
                        class="fab fa-twitter"></i></a>
                <a class="btn btn-square btn-link rounded-0 border-0 border-end border-secondary" href=""><i
                        class="fab fa-linkedin-in"></i></a>
                <a class="btn btn-square btn-link rounded-0" href=""><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </div>
</div>
<!-- Topbar End -->


<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0">
    <a href="{{ route('home') }}" class="navbar-brand">
        <img height="80" class="" src="{{asset('storage/images/logo.png')}}" alt="ESTHETIQUE">
    </a>
    <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto p-4 p-lg-0">
         <a class="nav-item nav-link active"
            href="{{ route('home') }}">Accueil</a>
            <a class="nav-item nav-link "
               href="{{ route('startreservation') }}">Reserver</a>
            --}}
{{--<a class="nav-item nav-link "
            href="{{ route('contact') }}">Conctact</a>--}}{{--

        </div>
        @if(auth()->check() && auth()->user()->user_type == 2)
        <a href="{{route('account')}}" class="btn btn-primary py-4 px-lg-5 d-none d-lg-block">Mon compte<i
                class="fa fa-arrow-down ms-3"></i></a>
        @else
            <a href="{{route('logincustomer')}}" class="btn btn-primary py-4 px-lg-5 d-none d-lg-block">Se connecter<i
                    class="fa fa-arrow-right ms-3"></i></a>
        @endif
    </div>
</nav>
<!-- Navbar End -->
--}}
