@extends('back.base')

@section('content')
    <div class="content-page">
        <div class="content">
        @include("back._partials.errors-and-messages")
        <!-- Start Content-->
            <div class="container-fluid">
                        <div class="card">
                            <div class="card-header">
                                <h4>Effectuer une facturation</h4>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{route('facturation.store')}}">
                                    {{csrf_field()}}
                                    <div class="row mt-1">
                                        <div class=" col-md-6">
                                            <label for="name" class="form-label">Client</label>
                                            <div class="input-group">
                                            <select name="customer_id" id="inputState" class="form-select">
                                                <option>Choisir le client</option>
                                                @foreach($customers as $item)
                                                    <option value="{{$item->id}}">{{$item->name}} {{$item->lastname}}</option>
                                                @endforeach
                                            </select>
                                                <a href="{{route('facturation.customer')}}" class="btn input-group-text btn-dark waves-effect waves-light" type="button">Ajouter client</a>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="name" class="form-label">Estheticiene</label>
                                            <select name="user_id" id="inputState" class="form-select">
                                                <option>Choisir l'estheticiene</option>
                                                @foreach($estheticiens as $item)
                                                    <option value="{{$item->id}}">{{$item->name}} {{$item->lastname}}</option>
                                                @endforeach
                                            </select></div>
                                    </div>
                                    <div class="row mt-1">
                                        <div class="col-md-12">
                                            <label for="name" class="form-label">Soin</label>
                                            <select name="soin_id" id="inputSoin" class="form-select">
                                                <option>Choisir le soin</option>
                                                @foreach($soins as $item)
                                                    <option data-duree="{{$item->duree}}" data-price="{{$item->price}}" value="{{$item->id}}">{{$item->libelle}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mt-1">
                                        <div class="col-md-6">
                                            <label for="name" class="form-label">Prix</label>
                                            <input class="form-control"  name="name" type="text" id="price" disabled placeholder="">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="name" class="form-label">Duree</label>
                                            <input class="form-control"  name="name" type="text" id="duree" disabled placeholder="">
                                        </div>
                                    </div>
                                    <div class=" p-3 mb-3 d-grid text-center">
                                        <button class="btn btn-success" type="submit"> Ajouter </button>
                                    </div>
                                </form>
                            </div>

                        </div>

            </div>
        </div>
    </div>

@endsection


