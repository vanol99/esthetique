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
                            <form method="POST" action="{{route('soin.update',['id'=>$soin->id])}}">
                                {{csrf_field()}}
                                <div class="row p-2">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Libelle</label>
                                        <input value="{{$soin->libelle}}" class="form-control" name="libelle" type="text" id="name" required="" placeholder="Enter libelle">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="name" class="form-label">Prix</label>
                                        <input value="{{$soin->price}}" class="form-control" name="price" type="number" id="name" required="" placeholder="Enter price">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="name" class="form-label">Duree</label>
                                        <input value="{{$soin->duree}}" class="form-control" name="duree" type="time" id="name" required="" placeholder="Enter your name">
                                    </div>
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Type soin</label>

                                        <select name="soin_type_id" id="inputState" class="form-select">
                                            <option>Choose</option>
                                            @foreach($soin_types as $item)
                                                <option value="{{$item->id}}">{{$item->libelle}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Description</label>
                                        <textarea value="{{$soin->description}}"  class="form-control" name="description" id="name" rows="4" required="" placeholder="Description"></textarea>
                                    </div>
                                </div>
                                <div class="mb-3 d-grid text-center">
                                    <button class="btn btn-success" type="submit"> Modifier </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


