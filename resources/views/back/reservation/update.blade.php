@extends('back.base')

@section('content')
    <div class="content-page">
        <div class="content">
        @include("back._partials.errors-and-messages")
        <!-- Start Content-->
            <div class="container-fluid">
                <div class="row mt-3">

                </div>
                <div class="row mt-3">
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                                <h5>Detail reservation</h5>
                                <dl class="row-md jh-entity-details">
                                    <dt>Date</dt>
                                    <dd>{{$soin->date_reservation}}</dd>
                                    <dt>Heure</dt>
                                    <dd>{{$soin->heure_reservation}}</dd>
                                    <dt>Soin</dt>
                                    <dd>{{$soin->soin->libelle}}</dd>
                                    <dt>Duree</dt>
                                    <dd>{{$soin->soin->duree}}</dd>
                                    <dt>personnel</dt>
                                    <dd>{{$soin->user->name}}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                            <h5>Detail Paiement</h5>
                                <dl class="row-md jh-entity-details">
                                    <dt>Status</dt>
                                    <dd>{{$soin->status}}</dd>
                                    <dt>Prix</dt>
                                    <dd>{{$soin->soin->price}}  <span class="mdi mdi-currency-eur"></span></dd>
                                    <dt>Mode paiement</dt>
                                    <dd>{{$soin->paiement}}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


