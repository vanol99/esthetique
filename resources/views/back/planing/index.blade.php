@extends('back.base')

@section('content')
    <div class="content-page">
        <span id="item_id" hidden></span>
        <div class="content">
        @include("back._partials.errors-and-messages")
        <!-- Start Content-->
            <div class="container-fluid">
                <div class="row mt-3">
                    <span id="date_"></span>
                    <span id="planingid_"></span>
                    <span id="delete_id"></span>
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3>Planings</h3>
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{route('planing',['date_start'=>$previous])}}"
                                           class="btn btn-sm btn-outline-primary"><i
                                                class="fas fa-arrow-alt-circle-left"></i>
                                        </a>
                                        <a type="button" class="btn btn-sm btn-outline-dark">
                                            <span>semaine du {{$header_weeks[0]['number']}}</span>
                                        </a>
                                            <a href="{{route('planing',['date_start'=>$next])}}" type="button" class="btn btn-sm btn-outline-primary"><i
                                              class="fas fa-arrow-alt-circle-right"></i>
                                            </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class=" table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                        <th>Estheticiene</th>
                                        @foreach($header_weeks as $periode)

                                            <th>{{ $periode['day'] }}
                                                <span>{{ $periode['number'] }}</span>
                                            </th>
                                        @endforeach
                                        </thead>
                                        <tbody>
                                        @foreach($body_weeks as $body)
                                            <tr>
                                                <td>
                                                    <a href="{{route('planing_week',['id'=>$body['line_id'],'date_start'=>$date_start])}}">
                                                        {{$body['line']}}</a>
                                                </td>
                                                @foreach($body['occupations'] as $periode)

                                                    <td>
                                                        <div style="display: block;width: 100%;height: 100%">
                                                            @if(!is_null($periode['planing']))
                                                            <a href="#"   onclick='getIdPlaning({{$periode['planing']->id}},"{{$periode['date_jour']}}")' data-bs-toggle="modal" data-bs-target="#bs-planing-repeat" >
                                                                <p data-bs-toggle="tooltip" data-bs-placement="top"
                                                                   title="Planifier sur les {{$periode['day']}} du mois">
                                                                    <span class="badge badge-soft-success">{{$periode['planing']->heure_debut}}</span> -
                                                                    <span class="badge badge-soft-dark">{{$periode['planing']->heure_fin}}</span>
                                                                </p>

                                                            </a>
                                                                <button  onclick='clickDeleteReservation({{$periode['planing']->id}})' class="btn btn-danger btn-sm"
                                                                         data-bs-toggle="modal" data-bs-target="#bs-planing-delete"
                                                                         title="Retirer">
                                                                    <i  data-bs-toggle="tooltip" data-bs-placement="top" class="mdi mdi-trash-can-outline"></i></button>
                                                            @else
                                                                @if(!is_null($periode['conge']))
                                                                    <a >
                                                                        <span class="badge badge-soft-danger">Congé: {{$periode['conge']->heure_debut}} {{$periode['conge']->heure_fin}}</span>
                                                                    </a>@endif
                                                                    <button  onclick='getIdPlaning({{$body['line_id']}},"{{$periode['date_jour']}}")' class="btn btn-success btn-sm"
                                                                             data-bs-toggle="modal"  data-bs-target="#bs-planing">
                                                                        <i class="mdi mdi-plus-circle"></i></button>
                                                            @endif
                                                        </div>
                                                    </td>

                                                @endforeach

                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="bs-planing" tabindex="-1" role="dialog"
         aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="mySmallModalLabel">Ajouter le planing</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="mb-3">
                            <label for="name" class="form-label">Heure de debut</label>
                            <input class="form-control" name="f_name" type="time" id="h_begin" required="" placeholder="Enter your name">
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Heure de fin</label>
                            <input class="form-control" name="f_name" type="time" id="h_end" required="" placeholder="Enter your name">
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <div class="mb-3 d-grid text-center">
                        <button class="btn btn-success" type="button" id="save_planing"> Enregistrer </button>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div>
    </div>
    <div class="modal fade" id="bs-planing-delete" tabindex="-1" role="dialog"
         aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="mySmallModalLabel">Supprimer le planing</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Vous souhaitez vraiment supprimer ce planing?</p>
                </div>
                <div class="modal-footer">
                    <div class="mb-3 d-grid text-center">
                        <button class="btn btn-danger" type="button" id="delete_planing"> Supprimer </button>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div>
    </div>
    <div class="modal fade" id="bs-planing-repeat" tabindex="-1" role="dialog"
         aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="mySmallModalLabel">Repeter le planing</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Vous souhaitez vraiment repeter ce planing sur tous les du mois?</p>
                </div>
                <div class="modal-footer">
                    <div class="mb-3 d-grid text-center">
                        <button class="btn btn-success" type="button" id="repeat_planing"> Repeter </button>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div>
    </div>
@endsection


