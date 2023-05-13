@extends('front.base')

@section('content')
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Home</a>
                    <a class="breadcrumb-item text-dark" href="#">Reservation</a>
                    <span class="breadcrumb-item active">Checkout</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->
    @include("back._partials.errors-and-messages")
    <div class="container-fluid">
        @if(isset($soin))
        <div class="row px-xl-5">
            <div class="col-md-8">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">
                        Detail commande</span></h5>
                <div class="bg-light p-30 mb-5">
                    <dl class="row-md jh-entity-details">
                        <dt>Soin</dt>
                        <dd>{{$soin->libelle}}</dd>
                        <dt>Duree</dt>
                        <dd>{{$soin->duree}}</dd>
                        <dt>Description</dt>
                        <dd>
                            {{$soin->description}}</dd>
                    </dl>
                </div>
            </div>
            <div class="col-md-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">
                        Sommaire</span></h5>
                <div class="bg-light p-30 mb-3">
                    <dl class="row-md jh-entity-details">
                        <dt>Date de reservation</dt>
                        <dd>{{session('date')}}</dd>
                        <dt>Heure de debut</dt>
                        <dd>{{session('start')}}</dd>
                        <dt>Montant</dt>
                        <dd>{{$soin->price}} <i class="fa fa-euro"></i></dd>
                        <dt>Montant total</dt>
                        <dd>{{$soin->price}} <i class="fa fa-euro"></i></dd>
                    </dl>
                    <hr>
                </div>
                <div>
                    <h5 class="section-title position-relative text-uppercase mb-1"><span class="bg-secondary pr-3">
                        Paiement</span></h5>
                    <div  class="bg-light p-30 mb-5">
                        <form method="POST">
                            {{csrf_field()}}
                            <div class="form-check form-check-danger mb-2">
                                <input class="form-check-input" name="customradio17" type="radio" id="customradio17" checked>
                                <label class="form-check-label" for="customradio17">Paiement au salon</label>
                            </div>
                            <div class="form-check form-check-danger mb-2">
                                <input class="form-check-input" name="customradio17" type="radio" id="customradio17" >
                                <label class="form-check-label" for="customradio17">Paypal</label>
                            </div>
                            <div class="form-check form-check-danger mb-2">
                                <input class="form-check-input" name="customradio17" type="radio" id="customradio17" >
                                <label class="form-check-label" for="customradio17">Bank Transfer</label>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-outline-success rounded-pill d-block">Je paie</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        @else
            <div class="text-center px-xl-5">
                <p class="h5">Panier vide</p><br>
                <div class="">
                    <a href="{{route('home')}}" type="button" class="btn btn-outline-success">Acceuil</a>
                </div>
            </div>
        @endif
    </div>

@endsection

