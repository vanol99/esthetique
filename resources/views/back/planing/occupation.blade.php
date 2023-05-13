@extends('back.base')

@section('content')
    <div class="content-page">
        <div class="content">
        @include("back._partials.errors-and-messages")
        <!-- Start Content-->
            <div class="container-fluid">
                <div class="card mt-3">
                    <div class="card-header"><h5>Occupations de {{$user->name}} {{$user->lastname}}</h5>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <div class="btn-group btn-group-sm">
                                <a href="{{route('planing_week',['id'=>$user->id,'date_start'=>$previous])}}"
                                   class="btn btn-sm btn-outline-primary"><i
                                        class="fas fa-arrow-alt-circle-left"></i>
                                </a>
                                <a type="button" class="btn btn-sm btn-outline-dark">
                                    <span>semaine du {{$occupations[0]['date']}}</span>
                                </a>
                                <a href="{{route('planing_week',['id'=>$user->id,'date_start'=>$next])}}" type="button" class="btn btn-sm btn-outline-primary"><i
                                        class="fas fa-arrow-alt-circle-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
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
                                        </div>

                                        <button class="btn btn-outline-success btn-sm" ><i class="mdi mdi-plus-circle"></i> affecter reservation</button>
                                    </td>
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



