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
                                <h3>Congés</h3>
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#bs-example-modal-sm"><i class="mdi mdi-plus-circle"></i>Ajouter un congé
                                        </button>

                                    </div>
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
                                            {{-- <th style="width: 15%">image</th>--}}
                                            <th style="width: 30%">Employé</th>
                                            <th>Date debut</th>
                                            <th>Date de fin</th>
                                            <th>Heure debut</th>
                                            <th>Heure fin</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>

                                        <tbody id="set-rows">
                                        @foreach($agents as $key=>$agent)
                                            <tr>
                                                <td>{{$agents->firstitem()+$key}}</td>
                                                <td>
                                                    {{$agent['user']->name}} {{$agent['user']->lastname}}
                                                </td>
                                                <td>
                                                    {{$agent['date_debut']}}
                                                </td>
                                                <td>
                                                    {{$agent['date_fin']}}
                                                </td>
                                                <td>
                                                    {{$agent['heure_debut']}}
                                                </td>
                                                <td>
                                                    {{$agent['heure_fin']}}
                                                </td>
                                                <td>
                                                    <a class="btn-sm btn-secondary p-1 pr-2 m-1"
                                                       href="{{route('conge.edit',[$agent['id']])}}">
                                                        <i class="mdi mdi-pencil pl-1" aria-hidden="true"></i>
                                                    </a>
                                                    <a class="btn-sm btn-danger p-1 pr-2 m-1"
                                                       data-bs-toggle="modal" data-bs-target="#bs-delete-modal-sm">
                                                        <i class="mdi mdi-trash-can pl-1" aria-hidden="true"></i>
                                                    </a>
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
    <div class="modal fade" id="bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="mySmallModalLabel">Ajouter un conge</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{route('conge.store')}}">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="mb-3">
                                <label for="name" class="form-label">Employé</label>
                                <select name="user_id" id="inputState" class="form-select">
                                    <option>Choose</option>
                                    @foreach($users as $item)
                                        <option value="{{$item->id}}">{{$item->name}} {{$item->lastname}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="name" class="form-label">Date Debut</label>
                                <input class="form-control" name="date_debut" type="date" id="name" required="" placeholder="Enter your name">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="name" class="form-label">Date Fin</label>
                                <input class="form-control" name="date_fin" type="date" id="name" required="" placeholder="Enter your name">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="name" class="form-label">Heure de debut</label>
                                <input class="form-control" name="heure_debut" type="time" id="name" required="" placeholder="Enter your name">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="name" class="form-label">Heure de fin</label>
                                <input class="form-control" name="heure_fin" type="time" id="name" required="" placeholder="Enter your name">
                            </div>
                        </div>
                        <div class="mb-3 d-grid text-center">
                            <button class="btn btn-success" type="submit"> Enregistrer </button>
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
                    <h4 class="modal-title" id="mySmallModalLabel">Supprimer le congé</h4>
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


