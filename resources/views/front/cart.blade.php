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
    <span hidden id="time"></span>
    <span hidden id="fixture_date"></span>
    <span hidden id="soin_id">{{$soin->id}}</span>
    <div class="container-fluid">
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
                {{--<div class="card">
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
                </div>--}}
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
    </div>
  {{--  <div class="container-xxl py-3">
        <span hidden id="time"></span>
        <span hidden id="fixture_date"></span>
        <span hidden id="soin_id">{{$soin->id}}</span>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3 border-2 border-danger">
                    <div class="card">
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
                    </div>
                </div>
                <div class="col-md-7 border-2 border-danger">
                    <div class="card">
                        <div class="card-header">
                            <h6>Selectionnez la date et heure </h6>
                        </div>
                        <div class="card-body">
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
                </div>
                <div class="col-md-2 border-2 border-danger">
                    <div class="row">
                        <H5>{{$soin->libelle}}</H5>
                    </div>
                    <dl class="row-md jh-entity-details">
                        <dt>Duree:</dt>
                        <dd>{{$soin->duree}}</dd>
                        <dt>Prix:</dt>
                        <dd>{{$soin->price}} <i class="fa fa-euro"></i></dd>
                    </dl>
                    <div class="row g-5">
                        <p>{!! Str::limit($soin->description, 100, ' ...') !!}</p>
                    </div>
                    <div class="row">
                        <div class="btn-grou">
                            <a id="btn_cart" class="btn btn-outline-success">Continuer</a>
                        </div>

                    </div>
                </div>

        </div>
        </div>

    </div>--}}

@endsection
{{--@push('scripts')
    <script src="{{asset('js/calendar.min.js')}}"></script>
@endpush--}}
