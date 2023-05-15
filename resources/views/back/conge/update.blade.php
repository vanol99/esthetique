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
                            <form method="POST" action="{{route('conge.update',['id'=>$soin->id])}}">
                                {{csrf_field()}}
                                <div class="row p-3">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Employé</label>
                                        <input value="{{$soin->user->name}} {{$soin->user->lastname}}" class="form-control" disabled type="text">
                                       {{-- <select name="user_id" id="inputState" class="form-select">
                                            <option>Choose</option>
                                            @foreach($users as $item)
                                                <option value="{{$item->id}}">{{$item->name}} {{$item->lastname}}</option>
                                            @endforeach
                                        </select>--}}
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="name" class="form-label">Date Debut</label>
                                        <input value="{{$soin->date_debut}}" class="form-control" name="date_debut" type="date" id="name" required="" placeholder="Enter your name">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="name" class="form-label">Date Fin</label>
                                        <input value="{{$soin->date_fin}}" class="form-control" name="date_fin" type="date" id="name" required="" placeholder="Enter your name">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="name" class="form-label">Heure de debut</label>
                                        <input value="{{$soin->heure_debut}}" class="form-control" name="heure_debut" type="time" id="name" required="" placeholder="Enter your name">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="name" class="form-label">Heure de fin</label>
                                        <input value="{{$soin->heure_fin}}" class="form-control" name="heure_fin" type="time" id="name" required="" placeholder="Enter your name">
                                    </div>
                                </div>
                                <div class="mb-3 text-center">
                                    <a class="btn btn-warning" type="button" href="{{route('conge.index')}}"><i class="mdi mdi-arrow-left"></i> annuler </a>
                                    <button class="btn btn-success" type="submit"> Update </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


