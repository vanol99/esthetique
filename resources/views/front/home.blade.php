@extends('front.base')

@section('content')

        @include("back._partials.errors-and-messages")
        <!-- Carousel Start -->
        <div class="container-fluid mb-3">
            <div class="row px-xl-5">
                <div class="col-lg-12">
                    <div id="header-carousel" class="carousel slide carousel-fade mb-30 mb-lg-0" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#header-carousel" data-slide-to="0" class="active"></li>
                            <li data-target="#header-carousel" data-slide-to="1"></li>
                            <li data-target="#header-carousel" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            @if($soins[0])
                                <div class="carousel-item position-relative active" style="height: 430px;">
                                    <img class="position-absolute w-100 h-100" src="{{ asset('multi/img/p738348.jpg') }}" style="object-fit: cover;">
                                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                        <div class="p-3" style="max-width: 700px;">
                                            <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">{{$soins[0]->type->libelle}}</h1>
                                            <p class="mx-md-5 px-5 animate__animated animate__bounceIn">{{$soins[0]->libelle}}</p>
                                            <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp"  href="{{route('cart',['id'=>$soins[0]->id])}}">Commander</a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if(sizeof($soins)>1)
                            <div class="carousel-item position-relative" style="height: 430px;">
                                <img class="position-absolute w-100 h-100" src="{{ asset('multi/img/p58766.jpg') }}" style="object-fit: cover;">
                                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                    <div class="p-3" style="max-width: 700px;">
                                        <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">{{$soins[1]->type->libelle}}</h1>
                                        <p class="mx-md-5 px-5 animate__animated animate__bounceIn">{{$soins[1]->libelle}}</p>
                                        <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp" href="{{route('cart',['id'=>$soins[1]->id])}}">Commander</a>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @if(sizeof($soins)>2)
                            <div class="carousel-item position-relative" style="height: 430px;">
                                <img class="position-absolute w-100 h-100" src="{{ asset('multi/img/p738348.jpg') }}" style="object-fit: cover;">
                                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                    <div class="p-3" style="max-width: 700px;">
                                        <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">{{$soins[2]->type->libelle}}</h1>
                                        <p class="mx-md-5 px-5 animate__animated animate__bounceIn">{{$soins[2]->libelle}}</p>
                                        <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp" href="{{route('cart',['id'=>$soins[2]->id])}}">Commander</a>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
               {{-- <div class="col-lg-4">
                    <div class="product-offer mb-30" style="height: 200px;">
                        <img class="img-fluid" src="{{ asset('storage/images/offer-1.jpg') }}" alt="">
                        <div class="offer-text">
                            <h6 class="text-white text-uppercase">Reduction 20%</h6>
                            <h3 class="text-white mb-3">Offre speciale</h3>
                            <a href="" class="btn btn-primary">Commander</a>
                        </div>
                    </div>
                    <div class="product-offer mb-30" style="height: 200px;">
                        <img class="img-fluid" src="{{ asset('storage/images/offer-2.jpg') }}" alt="">
                        <div class="offer-text">
                            <h6 class="text-white text-uppercase">Reduction 20%</h6>
                            <h3 class="text-white mb-3">Offre speciale</h3>
                            <a href="" class="btn btn-primary">Commander</a>
                        </div>
                    </div>
                </div>--}}
            </div>
        </div>
        <!-- Featured Start -->
        <div class="container-fluid pt-3">
            <div class="row px-xl-5 pb-3">
                <div class="col-md-6 col-sm-12 pb-1">
                    <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                        <h1 class="fas fa-check text-primary m-0 mr-3"></h1>
                        <h5 class="font-weight-semi-bold m-0">Produit de qualité</h5>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 pb-1">
                    <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                        <h1 class="fas fa-check-square text-primary m-0 mr-2"></h1>
                        <h5 class="font-weight-semi-bold m-0">Soins de qualité</h5>
                    </div>
                </div>
          {{--      <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                    <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                        <h1 class="fas fa-shipping-fast text-primary m-0 mr-3"></h1>
                        <h5 class="font-weight-semi-bold m-0">SAV</h5>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                    <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                        <h1 class="fas fa-phone-volume text-primary m-0 mr-3"></h1>
                        <h5 class="font-weight-semi-bold m-0">24/7 Support</h5>
                    </div>
                </div>--}}
            </div>
        </div>
        <!-- Categories Start -->
        <div class="container-fluid pt-3">
            <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Categories</span></h2>
            <div class="px-xl-5 pb-3">
                @foreach($allItems as $item)
                    <div class="card pb-3">
                        <div class="card-header">
                            {{$item['category']->libelle}}
                        </div>
                        <div class="card-body">
                         <table class="table">
                                <tbody>
                                @if(sizeof($item['soins'])==0)
                                    <tr>
                                        <td>Aucune donnee pour l'instant</td>
                                    </tr>
                                @endif
                                @foreach($item['soins'] as $soin)
                                    <tr>
                                        <td><a href="{{route('detailsoin',['slug'=>$soin->libelle])}}">{{$soin->libelle}}</a></td>
                                        <td>{{$soin->price}}<i class="fa fa-euro"></i></td>
                                        <td>{{$soin->duree}}</td>
                                        <td><div class="btn-grou">
                                                <a href="{{route('cart',['id'=>$soin->id])}}"
                                                   class="btn btn-outline-success">Reserver</a>
                                                <a href="{{route('cart',['id'=>$soin->id])}}"
                                                   class="btn btn-outline-dark">Offrir</a>
                                            </div></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <!-- Featured End -->
        <!-- Carousel End -->
        <!-- Carousel Start -->
   {{--     <div class="container-fluid p-0 wow fadeIn" data-wow-delay="0.1s">
            <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="w-100" height="600" src="{{ asset('storage/images/p738348.jpg') }}" alt="Image">
                        <div class="carousel-caption">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-lg-7">
                                        <h3 class="display-2 text-light mb-5 animated slideInDown">Soin de visage</h3>
                                        <a href="" class="btn btn-primary py-sm-3 px-sm-5">Detail</a>
                                        <a href="{{route('startreservation')}}" class="btn btn-light py-sm-3 px-sm-5 ms-3">Reserver</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img class="w-100" height="600" src="{{ asset('storage/images/p58766.jpg') }}" alt="Image">
                        <div class="carousel-caption">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-lg-7">
                                        <h1 class="display-2 text-light mb-5 animated slideInDown">Manicure</h1>
                                        <a href="" class="btn btn-primary py-sm-3 px-sm-5">Detail</a>
                                        <a href="" class="btn btn-light py-sm-3 px-sm-5 ms-3">Reserver</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel"
                        data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#header-carousel"
                        data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>--}}
        <!-- Carousel End -->

@endsection
