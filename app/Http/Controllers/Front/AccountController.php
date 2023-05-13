<?php


namespace App\Http\Controllers\Front;


use App\Helpers\helpers;
use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function account(Request $request)
    {
        $user=Auth::user();
        $historiques=Reservation::query()->where('customer_id','=',$user->id)
            ->latest()->paginate(Helpers::pagination_limit());
        return view('front.account', [
            'historiques'=>$historiques,
            'user'=>$user
        ]);
    }
    public function historique(Request $request)
    {
        return view('front.historique', []);
    }

}
