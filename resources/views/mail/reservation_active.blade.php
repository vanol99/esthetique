Hi, {{ $name }}
Votre commande du {{$reservation->date_reservation}}
@foreach($prestations as $prestation)
    <table class="table table-bordered mt-2">
        <thead>
        <th>#</th>
        <th>Soin</th>
        <th>Prix</th>
        <th>Duree</th>
        </thead>
        <tbody>
        @foreach($prestations as $prestation)
            <tr>
                <td></td>
                <td>{{$prestation->soin->libelle}}</td>
                <td>{{$prestation->soin->price}}</td>
                <td>{{$prestation->soin->duree}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endforeach


{{$content}}
