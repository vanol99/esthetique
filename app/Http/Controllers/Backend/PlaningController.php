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
use Illuminate\Support\Facades\Auth;

class PlaningController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if (!is_null($request->get('date_start'))) {
            $date_start = $request->get('date_start');
        } else {
            $date_start = date("Y-m-d");
        }
        $body_weeks = [];
        $day = new \DateTime($date_start);
        $users = User::query()->where("user_type", "=", 1)->get();
        for ($j = 0; $j <= 6; $j++) {
            $day_i = DateTimeHelper::daysOfWeekXML($date_start)[$j];
            $daym_ = new \DateTime($day_i);
            $id_var = getdate(mktime(1, 1, 1, $daym_->format('m'), $daym_->format('d'), $day->format('y')));
            $header_weeks[] = [
                'day' => DateTimeHelper::getDayByNumber($id_var['wday']),
                'number' => $day_i,
            ];
        }
        foreach ($users as $user) {
            $line_reservation_week = [];
            for ($j = 0; $j <= 6; $j++) {
                $day_i = DateTimeHelper::daysOfWeekXML($date_start)[$j];
                $conge = Conge::query()->where('date_debut', '<=', $day_i)
                    ->where('date_fin', '>', $day_i)
                    ->where('user_id', '=', $user->id)->first();
                $planing = Planing::query()
                    // ->where('status', '!=', Reservation::DENIED)
                    ->where('user_id', '=', $user->id)
                    ->where('date_planing', '>=', $day_i)
                    ->where('date_planing', '<', $day_i . ' 23:00:00')
                    ->orderBy('heure_debut', 'asc')->first();
                $daym_ = new \DateTime($day_i);
                $id_var = getdate(mktime(1, 1, 1, $daym_->format('m'), $daym_->format('d'), $daym_->format('y')));

                $line_reservation_week[] = [
                    'conge' => $conge,
                    'date_jour' => $day_i,
                    'day' => DateTimeHelper::getDayByNumber($id_var['wday']),
                    'planing' => $planing,
                ];
            }
            $body_weeks[] = [
                'line' => $user->name,
                'line_id' => $user->id,
                'occupations' => $line_reservation_week
            ];
        }
        $prevous_date=new \DateTime($header_weeks[0]['number']);
        $next_date=new \DateTime($header_weeks[6]['number']);
        $prevous_date->modify("-1 day");
        $next_date->modify("+1 day");

        return view('back.planing.index', [
            'users' => $users,
            "body_weeks" => $body_weeks,
            "date_start" => $date_start,
            "header_weeks" => $header_weeks,
            "previous"=>$prevous_date->format('Y-m-d'),
            "next"=>$next_date->format('Y-m-d'),
        ]);
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Soin $soin)
    {
        //
    }
    public function planing_change(Request $request){
        $planing_id = $request->get('planing_id');
        $planint_int=Planing::query()->find($planing_id);
        $date_ = $request->get('date');
        $arr=DateTimeHelper::getDaysofmonthBynumber($date_);
        for ($i=0;$i<sizeof($arr);$i++){
            $planing = Planing::query()->where('user_id', '=', $planint_int->user_id)
                ->where('date_planing', '=', $arr[$i])->first();
            if (is_null($planing)){
                $planing = new Planing();
                $planing->heure_debut = $planint_int->heure_debut;
                $planing->heure_fin = $planint_int->heure_fin;
                $planing->user_id = $planint_int->user_id;
                $planing->date_planing = $arr[$i];
                $planing->jour = DateTimeHelper::date($arr[$i]);
                $b_ool = $planing->save();
            }
        }
        return response()->json(['data' => $b_ool, 'status' => true]);
    }
    public function planing_week(Request $request, $id)
    {
        $user = User::find($id);
        $date_start = $request->get('date_start');
        $arrays = [];
        for ($j = 0; $j <= 6; $j++) {
            $day_i = DateTimeHelper::daysOfWeekXML($date_start)[$j];
            $daym_ = new \DateTime($day_i);
            $id_var = getdate(mktime(1, 1, 1, $daym_->format('m'), $daym_->format('d'), $daym_->format('y')));

            $reservations = Reservation::query()->where('user_id', '=', $id)
                ->where('date_reservation', '=', $day_i)->get();
            $planing = Planing::query()->where('user_id', '=', $id)
                ->where('date_planing', '=', $day_i)->first();
            $arrays[] = [
                'reservations' => $reservations,
                'date' => $day_i,
                'day' => DateTimeHelper::getDayByNumber($id_var['wday']),
                'planing' => $planing
            ];
        }
        $prevous_date=new \DateTime($arrays[0]['date']);
        $next_date=new \DateTime($arrays[6]['date']);
        $prevous_date->modify("-1 day");
        $next_date->modify("+1 day");
        return view('back.planing.occupation', [
            'user' => $user,
            'occupations' => $arrays,
            "previous"=>$prevous_date->format('Y-m-d'),
            "next"=>$next_date->format('Y-m-d'),
        ]);
    }

    public function planing_add(Request $request)
    {
        $user_id = $request->get('user_id');
        $date_ = $request->get('date');
        $planing = Planing::query()->where('user_id', '=', $user_id)
            ->where('date_planing', '=', $date_)->first();
        if (isset($planing)) {
            return response()->json(['data' => false, 'status' => true]);
        }
        $conge = Conge::query()->where('date_debut', '<=', $date_)
            ->where('date_fin', '>', $date_)
            ->where('user_id', '=', $user_id)->first();
        if (isset($conge)) {
            return response()->json(['data' => false, 'status' => true]);
        }
        $planing = new Planing();
        $planing->heure_debut = $request->get('heure_debut');
        $planing->heure_fin = $request->get('heure_fin');
        $planing->user_id = $user_id;
        $planing->date_planing = $date_;
        $planing->jour = DateTimeHelper::date($date_);
        $b_ool = $planing->save();
        return response()->json(['data' => $b_ool, 'status' => true]);
    }
    public function planing_remove(Request $request){
        $planing_id = $request->get('planing_id');
        $planing=Planing::query()->find($planing_id);
        $b_ool =  $planing->delete();
        return response()->json(['data' => $b_ool, 'status' => true]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Conge $soin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Conge $soin)
    {
        //
    }

    public function planingown(Request $request)
    {
        $user = Auth::user();
        $date_start = $request->get('date_start');
        if (is_null($date_start)) {
            $date_start = date('Y-m-d');
        }
        $arrays = [];
        for ($j = 0; $j <= 6; $j++) {
            $day_i = DateTimeHelper::daysOfWeekXML($date_start)[$j];
            $daym_ = new \DateTime($day_i);
            $id_var = getdate(mktime(1, 1, 1, $daym_->format('m'), $daym_->format('d'), $daym_->format('y')));

            $reservations = Reservation::query()->where('user_id', '=', $user->id)
                ->where('date_reservation', '=', $day_i)->get();
            $planing = Planing::query()->where('user_id', '=', $user->id)
                ->where('date_planing', '=', $day_i)->first();
            $arrays[] = [
                'reservations' => $reservations,
                'date' => $day_i,
                'day' => DateTimeHelper::getDayByNumber($id_var['wday']),
                'planing' => $planing
            ];
        }
        return view('back.planing.planingown', [
            'user' => $user,
            'occupations' => $arrays
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Conge $soin)
    {
        //
    }
}
