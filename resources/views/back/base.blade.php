<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{env('APP_NAME')}} | Gestion de salon</title>
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/app.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/icons.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>
<body class="loading" data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed",
"sidebar": { "color": "light", "size": "default", "showuser": true}, "topbar": {"color": "dark"},
 "showRightSidebarOnPageLoad": true}'>
<!-- Begin page -->

<div id="wrapper">
@include('back._partials._header')
    @include('back._partials._siderbard')
    @include("back._partials.errors-and-messages")
    @yield('content')
@include('back._partials._footer')
</div>
@stack('scripts')
<script src="{{asset('js/vendor.min.js') }}"></script>
<script src="{{asset('js/databases/jquery.dataTables.min.js') }}"></script>
<script src="{{asset('js/databases/dataTables.bootstrap5.min.js') }}"></script>
<script src="{{asset('js/app.min.js') }}"></script>
<script>
    var configs={
        routes:{
            index: "{{\Illuminate\Support\Facades\URL::to('/')}}",
            reportcalandar: "{{\Illuminate\Support\Facades\URL::route('reportcalandar')}}",
            sendmail: "{{\Illuminate\Support\Facades\URL::route('sendmail')}}",
            ajaxdeleteconge: "{{\Illuminate\Support\Facades\URL::route('delete_conge')}}",
            ajaxdeleteuser: "{{\Illuminate\Support\Facades\URL::route('estheticien.destroy')}}",
            ajaxdeletecustomer: "{{\Illuminate\Support\Facades\URL::route('customer.destroy')}}",
            ajaxdeleteproduct: "{{\Illuminate\Support\Facades\URL::route('product.destroy')}}",
            ajaxdeletecategorie: "{{\Illuminate\Support\Facades\URL::route('product_type.destroy')}}",
            ajaxdeletetypesoin: "{{\Illuminate\Support\Facades\URL::route('typesoin.destroy')}}",
            ajaxdeletesoin: "{{\Illuminate\Support\Facades\URL::route('soin.destroy')}}",
            ajaxdeletefacturation: "{{\Illuminate\Support\Facades\URL::route('facturation.destroy')}}",
            ajaxaddplaning: "{{\Illuminate\Support\Facades\URL::route('planing_add')}}",
            ajaxremoveplaning: "{{\Illuminate\Support\Facades\URL::route('planing_remove')}}",
            ajaxaplaning_change: "{{\Illuminate\Support\Facades\URL::route('planing_change')}}",
            getuserbyreservation: "{{\Illuminate\Support\Facades\URL::route('reservation.getuserbyreservation')}}",
        }
    }
</script>
<script src="{{asset('js/script.js') }}"></script>
<script type="text/javascript">
    $(function () {
        $('#duree').val($("#inputSoin option:selected").data('duree'))
        $('#price').val($("#inputSoin option:selected").data('price'))
        $('#inputSoin').change(function () {
            $('#duree').val($("#inputSoin option:selected").data('duree'))
            $('#price').val($("#inputSoin option:selected").data('price'))
        })
        $('#save_planing').click(function () {
            $.ajax({
                url: configs.routes.ajaxaddplaning,
                type: "GET",
                dataType: "JSON",
                data: {
                    'heure_debut':$('#h_begin').val(),
                    'heure_fin':$('#h_end').val(),
                    'user_id':$('#planingid_').text(),
                    'date':$('#date_').text(),
                },
                success: function (data) {
                    window.location.reload(true);
                },
                error: function (err) {
                    alert("An error ocurred while loading data ...");
                }
            });
        })
        $('#delete_planing').click(function () {
            console.log($('#delete_id').val())
            $.ajax({
                url: configs.routes.ajaxremoveplaning,
                type: "GET",
                dataType: "JSON",
                data: {
                    'planing_id':$('#delete_id').val(),
                },
                success: function (data) {
                    window.location.reload(true);
                },
                error: function (err) {
                    alert("An error ocurred while loading data ...");
                }
            });
        })
        $('#repeat_planing').click(function () {
            $.ajax({
                url: configs.routes.ajaxaplaning_change,
                type: "GET",
                dataType: "JSON",
                data: {
                    'planing_id':$('#planingid_').text(),
                    'date':$('#date_').text(),
                },
                success: function (data) {
                    window.location.reload(true);
                },
                error: function (err) {
                    alert("An error ocurred while loading data ...");
                }
            });
        })
    });
   function getIdPlaning(userid,id){
       $('#date_').text(id)
       $('#planingid_').text(userid)
        console.log(userid+"***"+id)
    }
    function clickReservation(id){
       $('#reservat_id').val(id)
        $.ajax({
            url: configs.routes.getuserbyreservation,
            type: "GET",
            dataType: "JSON",
            data: {
                'id':id,
            },
            success: function (data) {
                $('#user_reservation_id').html('')
                $('#user_reservation_id').append("<option>Choisir un specialiste</option>")
                $.each(data.data, function (index, item) {
                    $('#user_reservation_id').append("<option value='"+item.id+"'>"+item.name+"</option>")
                })
                // window.location.reload(true);
            },
            error: function (err) {
                alert("An error ocurred while loading data ...");
            }
        });
    }
    function clickDeleteReservation(id){
        $('#delete_id').val(id)
    }

</script>
</body>

</html>
