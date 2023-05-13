<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\DateTimeHelper;
use App\Helpers\helpers;
use App\Http\Controllers\Controller;
use App\Models\Conge;
use App\Models\Planing;
use App\Models\Reservation;
use App\Models\Soin;
use App\Models\User;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query_param = [];
        $search = $request['search'];
        if ($request->has('search')) {
            $key = explode(' ', $request['search']);
            $agents = Reservation::where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->orWhere('date_reservation', 'like', "%{$value}%")
                        ->orWhere('heure_reservation', 'like', "%{$value}%")
                       // ->orWhere('phone', 'like', "%{$value}%")
                       // ->orWhere('email', 'like', "%{$value}%")
                    ;
                }
            });
            $query_param = ['search' => $request['search']];
        } else {
            $agents = new Reservation();
        }

        $agents = $agents->newQuery()->where(['status'=>Reservation::ACCEPTED])->latest()->paginate(Helpers::pagination_limit())->appends($query_param);
        return view('back.reservation.index', compact('agents', 'search'));
    }
    public function pending(Request $request)
    {
        $query_param = [];
        $search = $request['search'];
        if ($request->has('search')) {
            $key = explode(' ', $request['search']);
            $agents = Reservation::where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->orWhere('date_reservation', 'like', "%{$value}%")
                        ->orWhere('heure_reservation', 'like', "%{$value}%")
                        // ->orWhere('phone', 'like', "%{$value}%")
                        // ->orWhere('email', 'like', "%{$value}%")
                    ;
                }
            });
            $query_param = ['search' => $request['search']];
        } else {
            $agents = new Reservation();
        }

        $agents = $agents->newQuery()->where(['status'=>Reservation::PENDING])->latest()->paginate(Helpers::pagination_limit())->appends($query_param);
        return view('back.reservation.pending', compact('agents', 'search'));
    }
    public function reject(Request $request)
    {
        $query_param = [];
        $search = $request['search'];
        if ($request->has('search')) {
            $key = explode(' ', $request['search']);
            $agents = Reservation::where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->orWhere('date_reservation', 'like', "%{$value}%")
                        ->orWhere('heure_reservation', 'like', "%{$value}%")
                        // ->orWhere('phone', 'like', "%{$value}%")
                        // ->orWhere('email', 'like', "%{$value}%")
                    ;
                }
            });
            $query_param = ['search' => $request['search']];
        } else {
            $agents = new Reservation();
        }

        $agents = $agents->newQuery()->where(['status'=>Reservation::DENIED])->latest()->paginate(Helpers::pagination_limit())->appends($query_param);
        return view('back.reservation.reject', compact('agents', 'search'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $soin=Reservation::find($id);
        return view('back.reservation.update', compact('soin'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request,$id)
    {
        $reservation=Reservation::find($id);
        if ($request->get('status')=="valide"){
            $reservation->update([
               'status'=>Reservation::ACCEPTED
            ]);
            $data=['reservation'=>$reservation,"subject"=>"Reservation validée",'message'=>'','user'=>$reservation->user];
            helpers::send_reservation_active($data);
        }else{
            $reservation->update([
                'status'=>Reservation::DENIED
            ]);
            $data=['reservation'=>$reservation,"subject"=>"Reservation echouée",'message'=>'','user'=>$reservation->user];
            helpers::send_reservation_active($data);
        }
        return redirect()->route('reservation');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

    }
    function affecter(Request $request){
       $reservation= Reservation::query()->find($request->get('id'));
       $reservation->update([
          'user_id'=>$request->get('user_reservation_id')
       ]);
        return redirect()->route('reservation');
    }
    public function getuserbyreservation(Request $request)
    {
        $reservation_id=$request->get('id');

        $reservation=Reservation::query()->find($reservation_id);
        $h_reservation=$reservation->heure_reservation;
        $date_=$reservation->date_reservation;
        $planings=Planing::query()->where('date_planing','=',$date_)
            ->where('heure_debut','<=',$h_reservation)
            ->where('heure_fin','>',$h_reservation)->get();
        $arrays=array_map(function ($item){
            return User::find($item['user_id']);
        },$planings->toArray());
        return response()->json(['data' => $arrays, 'status' => true]);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Conge $soin)
    {

    }
}
