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
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3>Reservations en attente</h3>
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">

                                </div>
                            </div>
                            <div class="card-body">
                                <!-- Table -->
                                <div class="table-responsive datatable-custom">
                                    <table
                                        class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                                        <thead class="thead-light">
                                        <tr>
                                            <th>#N°</th>
                                            <th style="width: 30%">Client</th>

                                            <th>Date de reservation</th>
                                            <th>heure de reservation</th>
                                            <th>Soin</th>
                                            <th>Prix</th>
                                            <th>Specialiste</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>

                                        <tbody id="set-rows">
                                        @foreach($agents as $key=>$agent)
                                            <tr>
                                                <td>{{$agents->firstitem()+$key}}</td>

                                                <td>
                                                    {{$agent['customer']->name}}
                                                </td>
                                                <td>
                                                    {{$agent['date_reservation']}}
                                                </td>
                                                <td>
                                                    {{$agent['heure_reservation']}}
                                                </td>
                                                <td>
                                                    {{$agent['soin']->libelle}}
                                                </td>
                                                <td>
                                                    {{$agent['soin']->price}} <span class="mdi mdi-currency-eur"></span>
                                                </td>
                                                <td>
                                                    @if($agent['user'])
                                                    {{$agent['user']->name}} {{$agent['user']->lastname}}
                                                    @else
                                                        <span class="badge-soft-dark">Pas de preference</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($agent['status']=="PENDING")
                                                        <span class="btn btn-sm btn-outline-warning">{{$agent['status']}}</span>
                                                    @elseif($agent['status']=="ACCEPTED")
                                                        <span class="btn btn-sm btn-outline-success">{{$agent['status']}}</span>
                                                    @else
                                                        <span class="btn btn-sm btn-outline-danger">{{$agent['status']}}</span>
                                                    @endif


                                                </td>
                                                <td>
                                                    <div class="dropdown mt-sm-0 mt-2">
                                                        <button type="button" class="btn btn-primary waves-effect waves-light dropdown-toggle"
                                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="mdi mdi-chevron-down"></i>
                                                        </button>

                                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink">
                                                            <a class="dropdown-item" href="{{route('reservation.show',[$agent['id']])}}">
                                                                <i class="mdi mdi-pencil pl-1" aria-hidden="true"></i> Detail
                                                            </a>
                                                            @if($agent['status']===\App\Models\Reservation::PENDING)
                                                            <a class="dropdown-item" href="{{route('reservation.edit',[$agent['id'],'status'=>"valide"])}}">
                                                                <i class="mdi mdi-check-bold pl-1" aria-hidden="true"></i> Valider
                                                            </a>

                                                                <a class="dropdown-item" href="{{route('reservation.edit',[$agent['id'],'status'=>"rejete"])}}">
                                                                    <i class="mdi mdi-stop-circle pl-1" aria-hidden="true"></i> Rejeter
                                                                </a>
                                                            @endif
                                                            <a href="#" class="dropdown-item" onclick="clickReservation({{$agent['id']}})" data-bs-toggle="modal" data-bs-target="#bs-example-modal-md">
                                                                <i class="mdi mdi-relation-many-to-many pl-1" aria-hidden="true"></i>Affecter personnel
                                                            </a>
                                                            <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#bs-delete-modal-sm">
                                                                <i class="mdi mdi-trash-can pl-1" aria-hidden="true"></i>Supprimer
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>

                                </div>
                                <!-- End Table -->
                            </div>
                            <!-- Footer -->
                            <div class="card-footer">
                                <!-- Pagination -->
                                <div class="row justify-content-center justify-content-sm-between align-items-sm-center">
                                    <div class="col-sm-auto">
                                        <div class="d-flex justify-content-center justify-content-sm-end">
                                            <!-- Pagination -->
                                            {!! $agents->links() !!}
                                            <nav id="datatablePagination" aria-label="Activity pagination"></nav>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Pagination -->
                            </div>
                            <!-- End Footer -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="bs-example-modal-md" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="mySmallModalLabel">Affecter un(e) specialiste</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{route('reservation.affecter')}}">
                        {{csrf_field()}}
                        <div class="row">
                            <input name="id" id="reservat_id" hidden>
                            <div class="mb-3">
                                <label for="name" class="form-label">Liste de specialiste disponible pour cette heure</label>
                                <select name="user_reservation_id" id="user_reservation_id" class="form-select">
                                    <option>Choose</option>

                                </select>
                            </div>

                        </div>
                        <div class="mb-3 d-grid text-center">
                            <button class="btn btn-success" type="submit"> Affecter </button>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <div class="modal fade" id="bs-delete-modal-sm" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="mySmallModalLabel">Supprimer le type de soin</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Cette action est irreverssible</p>
                    <form>
                        {{csrf_field()}}

                        <div class="mb-3 d-grid text-center">
                            <button class="btn btn-danger" type="button" id="delete_btn"> Supprimer </button>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

@endsection


