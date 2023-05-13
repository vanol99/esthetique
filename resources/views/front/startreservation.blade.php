@extends('front.base')

@section('content')
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Home</a>
                    <a class="breadcrumb-item text-dark" href="#">Reservation</a>
                    <span class="breadcrumb-item active">Categories</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->
    @include("back._partials.errors-and-messages")
    <!-- Categories Start -->
    <div class="container-fluid pt-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Categories</span></h2>
        <div class="bg-light p-5 mb-1">
            <div class="px-xl-1">
                @foreach($allItems as $item)
                    <div class="card pb-1">
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
    </div>
   {{-- <div class="container-xxl py-0">
        <div class="container">
            @foreach($allItems as $item)
                <div class="card">
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
                           </tr>    @endforeach
                           </tbody>
                       </table>
                    </div>
                </div>
            @endforeach
            --}}{{--<div class="row">

                @if((sizeof($soins)==0))
                    <span class="h5">Aucun soin disponible</span>
                    @endif
                @foreach($soins as $soin)
                    <div class="col-md-4 border-2 border-danger">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <H5>{{$soin->libelle}}</H5>
                                </div>
                                <dl class="row-md jh-entity-details">
                                    <dt>Duree:</dt>
                                    <dd>{{$soin->duree}}</dd>
                                    <dt>Prix:</dt>
                                    <dd>{{$soin->price}} <i class="fa fa-euro"></i></dd>
                                    <dt>Description:</dt>
                                    <dd>{{$soin->description}}</dd>
                                </dl>

                            </div>
                            <div class="card-footer">
                                <div class="btn-grou">
                                    <a href="{{route('cart',['id'=>$soin->id])}}"
                                       class="btn btn-outline-success">Reserver</a>
                                    <a href="{{route('cart',['id'=>$soin->id])}}"
                                       class="btn btn-outline-dark">Offrir</a>
                                </div>
                            </div>
                        </div>

                    </div>

                @endforeach
            </div>--}}{{--
        </div>

    </div>--}}

@endsection
