@extends('back.base')

@section('content')
    <div class="content-page">
        <div class="content">
        @include("back._partials.errors-and-messages")
        <!-- Start Content-->
            <div class="container-fluid">

                <div class="row mt-3">
                    <div class="col-12">
                        <div class="card">
                            <form method="POST" action="{{route('soin.product',['id'=>$soin->id])}}">
                                {{csrf_field()}}
                                <div class="row p-2">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Products</label>
                                        <div class="input-group">
                                        <select name="product_id" id="inputState" class="form-select">
                                            <option>Choose</option>
                                            @foreach($products as $item)
                                                <option value="{{$item->id}}">{{$item->libelle}}</option>
                                            @endforeach
                                        </select>
                                            <button class="btn input-group-text btn-dark waves-effect waves-light" type="submit">Ajouter le produit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="card">
                        <div class="card-header">
                            <h5>Products du soin {{$soin->libelle}}</h5>
                        </div>
                        <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Produit</th>
                            <th>Prix</th>
                            <th>Prix de vente</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($soin->products as $product)
                            <tr>
                                <td><img class="rounded-circle" height="80px" width="80px" style="cursor: pointer"

                                         src="{{asset('storage/product')}}/{{$product->image}}"></td>
                                <td>{{$product->libelle}}</td>
                                <td>{{$product->price}}</td>
                                <td>{{$product->price_sell}}</td>
                                <td><a class="btn btn-sm btn-danger" href="{{route('soin.removeproduct',['soin_id'=>$soin->id,'product_id'=>$product->id])}}"><i class="mdi mdi-trash-can-outline"></i></a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table> </div>
            </div>
                </div>
            </div>
        </div>
    </div>

@endsection


