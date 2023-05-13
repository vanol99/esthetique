@extends('back.base')

@section('content')
    <div class="content-page">
        <div class="content">
        @include("back._partials.errors-and-messages")
        <!-- Start Content-->
            <div class="container-fluid">
                <div class="card mt-3">
                    <div class="card-header"><h5>Mon planing</h5></div>
                    <div class="card-body taskboard-box taskList">
                        <table class="table table-bordered">
                            <thead>
                            <th>Jour</th>
                            <th>Occupations</th>
                            </thead>
                            <tbody>
                            @foreach($occupations as $item)
                                <tr>
                                    <td>{{$item['day']}} {{$item['date']}}
                                        @if($item['planing'])
                                            <p> <span class="badge badge-soft-blue">{{$item['planing']->heure_debut}}</span>
                                                <span class="badge badge-soft-danger">{{$item['planing']->heure_fin}}</span></p>
                                        @endif
                                    </td>
                                    <td id="tooltip-container">
                                        <div class="row">
                                            @if(sizeof($item['reservations'])==0)
                                                <span class="badge badge-soft-dark rounded-2">Aucun soin affecter</span>
                                            @endif
                                            @foreach($item['reservations'] as $reservation)

                                                <div class="col-3 kanban-detail">
                                                    <h5 class="mt-0"><a href="#" class="text-dark"></a> {{$reservation->soin->libelle}}</h5>
                                                    <ul class="list-inline">
                                                        <li class="list-inline-item">
                                                                  <span  data-bs-container="#tooltip-container" data-bs-toggle="tooltip" data-bs-placement="top"
                                                                         title="Heure debut" class="badge bi-badge-4k badge-soft-dark">{{$reservation->heure_reservation}}</span>

                                                        </li>
                                                        <li class="list-inline-item">
                                                            <a href="" data-bs-toggle="tooltip" data-bs-placement="top"
                                                               title="Duree">
                                                                <i class="mdi mdi-timeline-clock"></i>{{$reservation->soin->duree}}
                                                            </a>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <a href="" data-bs-toggle="tooltip" data-bs-placement="top"
                                                               title="Prix">
                                                                <i class="mdi mdi-currency-eur"></i>{{$reservation->soin->price}}
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            @endforeach
                                        </div></td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection



