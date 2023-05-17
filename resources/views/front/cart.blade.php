@extends('front.base')

@section('content')

    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Home</a>
                    <a class="breadcrumb-item text-dark" href="#">Reservation</a>
                    <span class="breadcrumb-item active">Cart</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->
    @include("back._partials.errors-and-messages")

    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                    <tr>
                        <th>Prestations</th>
                        <th>Prix</th>
                        <th>Durée</th>
                        <th>Remove</th>
                    </tr>
                    </thead>
                    <tbody class="align-middle">

                    @foreach($soins as $product)
                    <tr>
                        <td class="align-middle"><img src="img/product-1.jpg" alt="" style="width: 50px;"> {{$product->libelle}}</td>
                        <td class="align-middle"><i class="fa fa-euro"></i>{{$product->price}}</td>
                        <td class="align-middle">{{$product->duree}}</td>
                        <td class="align-middle"><a href="{{route('removesession',['id'=>$product->id])}}" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a></td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                <a href="{{route('startreservation')}}" class="h6 mt-2 pull-right">Ajouter un soin</a>
            </div>
            <div class="col-lg-4">
                {{--  <form class="mb-30" action="">
                     <div class="input-group">
                    -   <input type="text" class="form-control border-0 p-4" placeholder="Coupon Code">
                         <div class="input-group-append">
                             <button class="btn btn-primary">Apply Coupon</button>
                         </div>
                    </div>
                </form>--}}
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Sub-Total</h6>
                            <h6>{{$totalht}}<i class="fa fa-euro"></i></h6>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <h6 class="font-weight-medium">Tva</h6>
                            <h6 class="font-weight-medium">{{$totaltva}}<i class="fa fa-euro"></i></h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Reduction</h6>
                            <h6 class="font-weight-medium">0.0<i class="fa fa-euro"></i></h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5>{{$total}}<i class="fa fa-euro"></i></h5>
                        </div>
                        <a href="{{route('cartfinal')}}" class="btn btn-block btn-primary font-weight-bold my-3 py-3">Continue</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
    {{--<div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-md-3 border-2 border-danger">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">
                        Selectionnez votre estheticiene</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="form-check mb-2">
                        <input class="form-check-input" value="0" type="radio" name="flexpersonnel" id="customradio1" checked>
                        <label class="form-check-label" for="customradio1">none</label>
                    </div>
                    @foreach($users as $user)
                        <div class="form-check mb-2">
                            <input class="form-check-input" value="{{$user->id}}" type="radio" name="flexpersonnel" id="customradio1">
                            <label class="form-check-label" for="customradio1">{{$user->name }} {{$user->lastname }}</label>
                        </div>
                    @endforeach
                </div>
                --}}{{--<div class="card">
                    <span id="soin_id" hidden>{{$soin->id}}</span>
                    <div class="card-header">
                        <span class="h6">Selectionnez votre estheticiene </span>
                    </div>
                    <div class="card-body">
                        <div class="form-check mb-2">
                            <input class="form-check-input" value="0" type="radio" name="flexpersonnel" id="customradio1" checked>
                            <label class="form-check-label" for="customradio1">none</label>
                        </div>
                        @foreach($users as $user)
                            <div class="form-check mb-2">
                                <input class="form-check-input" value="{{$user->id}}" type="radio" name="flexpersonnel" id="customradio1">
                                <label class="form-check-label" for="customradio1">{{$user->name }} {{$user->lastname }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>--}}{{--
            </div>
            <div class="col-md-7 border-2 border-danger">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">
                        Selectionnez la date et heure</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="calendar">
                                <main>
                                    <div class="calendar-wrapper" id="calendar-wrapper"></div>
                                </main>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div id="cart_heure">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2 border-2 border-danger">
                <h6 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">
                        {{$soin->libelle}}</span></h6>
                <div class="bg-light p-30 mb-5">
                    <dl class="row-md jh-entity-details">
                        <dt>Duree:</dt>
                        <dd>{{$soin->duree}}</dd>
                        <dt>Prix:</dt>
                        <dd>{{$soin->price}} <i class="fa fa-euro"></i></dd>
                    </dl>
                    <div class="row g-5">
                        <p>{!! Str::limit($soin->description, 100, ' ...') !!}</p>
                    </div>
                </div>
                <div class="bg-light p-30 mb-5">
                    <div class="btn-grou">
                        <a id="btn_cart" class="btn btn-outline-success">Continuer</a>
                    </div>
                </div>

            </div>
        </div>
    </div>--}}


@endsection
{{--@push('scripts')
    <script src="{{asset('js/calendar.min.js')}}"></script>
@endpush--}}
