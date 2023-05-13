Hi, {{ $name }}
Votre commande du {{$reservation->date_reservation}}
Soin: {{$reservation->soin->libelle}}
Prix: {{$reservation->soin->price}}
Duree: {{$reservation->soin->duree}}

{{$content}}
