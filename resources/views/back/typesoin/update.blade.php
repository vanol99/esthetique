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
                            <form method="POST" action="{{route('typesoin.update',['id'=>$soin->id])}}">
                                {{csrf_field()}}
                                <div class="row p-3">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Libelle</label>
                                        <input value="{{$soin->libelle}}" class="form-control" name="libelle" type="text" id="name" required="" placeholder="Enter your name">
                                    </div>

                                </div>
                                <div class="p-3 d-grid text-center">
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


