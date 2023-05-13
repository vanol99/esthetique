@extends('front.base')

@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid page-header py-6 my-6 mt-0 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center">
            <h1 class="display-4 text-white animated slideInDown mb-4">Historique</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                    <li class="breadcrumb-item"><a class="text-white" href="#">Historique</a></li>
                    <li class="breadcrumb-item text-primary active" aria-current="page">Soins</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->
    @include("back._partials.errors-and-messages")
    <div class="container-xxl py-3">
        <div class="container">
            <div class="row">
            @foreach($soins as $soin)
                    <div class="col-md-4 border-2 border-danger">
                <div class="row">
                    <H4>{{$soin->libelle}}</H4>
                    <p><i class="fa fa-clock"></i> {{$soin->duree}}</p>
                    <p><i class="fa fa-dollar"></i> {{$soin->price}} </p>
                </div>
                <div class="row g-5">
                    <p>{{$soin->description}}</p>
                </div>
                <div class="row">
                    <div class="btn-grou">
                        <a href="{{route('cart',['id'=>$soin->id])}}" class="btn btn-outline-success">Reserver</a>
                    </div>

                </div>
                    </div>
            @endforeach
        </div>
        </div>

    </div>

@endsection
