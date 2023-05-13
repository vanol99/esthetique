@extends('front.base')

@section('content')
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Home</a>
                    <span class="breadcrumb-item active">Detail du soin</span>
                </nav>
            </div>
        </div>
    </div>
    <span hidden id="time"></span>
    <span hidden id="fixture_date"></span>
    <span hidden id="soin_id">{{$soin->id}}</span>
    <!-- Breadcrumb End -->
    @include("back._partials.errors-and-messages")
    <div class="container-fluid">

        <div class="row px-xl-5">
            <div class="col-md-4 border-2 border-danger">
                <h5 class="section-title position-relative text-uppercase mx-xl-5 mb-4">
                    <span class="bg-secondary pr-3">Détail</span></h5>
                <div  class="bg-light p-30 mb-5">
                <dt>Soin:</dt>
                <dd>{{$soin->libelle}}</dd>
                <dt>Duree:</dt>
                <dd>{{$soin->duree}}</dd>
                <dt>Prix:</dt>
                <dd>{{$soin->price}} <i class="fa fa-euro"></i></dd>
                <div class="btn-grou mt-2">
                    <a href="{{route('cart',['id'=>$soin->id])}}"
                       class="btn btn-outline-success">Reserver</a>
                    <a href="{{route('cart',['id'=>$soin->id])}}"
                       class="btn btn-outline-dark">Offrir</a>
                </div>
                </div>
            </div>

            <div class="col-md-8 border-2 border-danger">
                <h5 class="section-title position-relative text-uppercase mx-xl-5 mb-4">
                    <span class="bg-secondary pr-3">Description</span></h5>
                <div  class="bg-light p-30 mb-5">
                {{$soin->description}}
                </div>
            </div>
        </div>
    </div>
{{--    <div class="container-xxl py-3">
        <span hidden id="time"></span>
        <span hidden id="fixture_date"></span>
        <span hidden id="soin_id">{{$soin->id}}</span>
        <div class="container">
            <div class="row">
                <div class="col-md-4 border-2 border-danger">
                    <dt>Soin:</dt>
                    <dd>{{$soin->libelle}}</dd>
                    <dt>Duree:</dt>
                    <dd>{{$soin->duree}}</dd>
                    <dt>Prix:</dt>
                    <dd>{{$soin->price}} <i class="fa fa-euro"></i></dd>
                    <div class="btn-grou mt-2">
                        <a href="{{route('cart',['id'=>$soin->id])}}"
                           class="btn btn-outline-success">Reserver</a>
                        <a href="{{route('cart',['id'=>$soin->id])}}"
                           class="btn btn-outline-dark">Offrir</a>
                    </div>
                </div>

                <div class="col-md-8 border-2 border-danger">
                    <p class="h4">Description</p>
                    {{$soin->description}}
                </div>
            </div>
        </div>

    </div>--}}

@endsection

