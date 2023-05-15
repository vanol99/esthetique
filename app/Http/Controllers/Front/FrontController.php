<?php


namespace App\Http\Controllers\Front;


use App\Helpers\DateTimeHelper;
use App\Helpers\helpers;
use App\Http\Controllers\Controller;
use App\Models\Planing;
use App\Models\Prestation;
use App\Models\Reservation;
use App\Models\Soin;
use App\Models\Soin_type;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Psr\Log\LoggerInterface;

class FrontController extends Controller
{
    private $logger;

    /**
     * FrontController constructor.
     * @param $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function home(Request $request)
    {
        $allItems = [];
        $categories = Soin_type::all();
        foreach ($categories as $category) {
            $soins = Soin::query()->where('soin_type_id', '=', $category->id)
                ->get();
            $allItems[] = [
                'category' => $category,
                'soins' => $soins

            ];
        }
        $soins = Soin::query()->inRandomOrder()->limit(3)->get();
        return view('front.home', [
            'soins' => $soins,
            'allItems' => $allItems
        ]);
    }

    public function contact(Request $request)
    {
        return view('front.contact', [

        ]);
    }

    public function checkout(Request $request)
    {
        $customer = Auth::user();
        if (!isset($customer)) {
            return redirect()->route('logincustomer');
        }
        //$soin = Soin::query()->find(session('soin_id'));
        $soins = Session::get("soins");
        $total=0.0;
        $arrays=[];
        foreach (array_unique($soins) as $item){
            $soin = Soin::query()->find($item);
            if (isset($soin)) {
                $arrays[] = $soin;

                $total += $soin->price;
            }
        }
        if ($request->method() == "POST") {

            $reservation = new Reservation();
            $reservation->date_reservation = session('date');
            $reservation->heure_reservation = session('start');
            //$reservation->soin_id = session('soin_id');
            $reservation->customer_id = $customer->id;
            $reservation->status = Reservation::PENDING;
            $reservation->user_id = session('user_id');
            $reservation->save();
            $soins = Session::get("soins");
            $total=0.0;
            $arrays=[];
            foreach (array_unique($soins) as $item){
                $soin = Soin::query()->find($item);
                if (isset($soin)) {
                 $prestation=new Prestation();
                 $prestation->reservation_id=$reservation->id;
                 $prestation->soin_id=$soin->id;
                 $prestation->save();
                    $total += $soin->price;
                }
                $arrays[]=$prestation;
            }
            $reservation->update([
               'total'=>$total
            ]);
            $data = ['reservation' => $reservation,'prestations'=>$arrays, "subject" => "Reservation echouée", 'message' => '', 'user' => $reservation->user];
            helpers::send_reservation_active($data);
            Session::remove("soin_id");
            Session::remove("start");
            Session::remove("date");
            Session::remove("user_id");
            return redirect()->route('account');
        }
        return view('front.checkout', [
            "soins" => $arrays,
            "total"=>$total,
            "start" => session('start'),
            "date" => session('date'),
        ]);
    }

    public function checkoutsession(Request $request)
    {
        Session::put('soin_id', $request->get('item'));
        Session::put('start', $request->get('start'));
        Session::put('date', $request->get('date'));
        Session::put('user_id', $request->get('user_id'));

        return response()->json(['data' => "", 'status' => true]);
    }

    public function detailsoin(Request $request)
    {
        $soin = Soin::query()->where(['libelle' => $request->get('slug')])->first();

        return view('front.detailsoin', [
            'soin' => $soin,
        ]);
    }

    public function cart(Request $request)
    {
        // Session::remove('soins');
        $arrays = [];
        // $soin_s[] = Session::get("soins");
        //if (!array_key_exists($request->get('id'), $soin_s)) {
        Session::push('soins', $request->get('id'));
        //  }
        $soins = Session::get("soins");

        Session::put('soins', array_unique($soins));
        $total = 0.0;

/*        for ($i = 0; $i < sizeof(array_unique($soins)); $i++) {
            $soin = Soin::query()->find($soins[$i]);
            if (isset($soin)) {
                $arrays[] = $soin;

                $total += $soin->price;
            }

        }*/
        foreach (array_unique($soins) as $item){
            $soin = Soin::query()->find($item);
            if (isset($soin)) {
                $arrays[] = $soin;

                $total += $soin->price;
            }
        }

       // dump($soins);
        return view('front.cart', [
            'total' => $total,
            'soins' => $arrays,
        ]);
    }

    public function removesession(Request $request)
    {
        $soin_id = $request->get('id');
        $soins = Session::get('soins');
        $soins = array_filter($soins, function ($tem) use ($soin_id) {
            return $tem != $soin_id;
        });
        Session::put('soins', $soins);
        return redirect()->route('cart');
    }

    public function startreservation(Request $request)
    {
        $allItems = [];
        $categories = Soin_type::all();
        foreach ($categories as $category) {
            $soins = Soin::query()->where('soin_type_id', '=', $category->id)
                ->get();
            $allItems[] = [
                'category' => $category,
                'soins' => $soins

            ];
        }
        $soins = Soin::query()->get();
        return view('front.startreservation', [
            'soins' => $soins,
            'allItems' => $allItems
        ]);
    }

    public function cartfinal(Request $request)
    {
       // Session::remove("soin_id");
       // $soin_id = Session::get('soins')[2];
        $users = User::query()->where("user_type", "=", 1)->get();
        $soins = Session::get("soins");
        $total=0.0;
        $arrays=[];
        foreach (array_unique($soins) as $item){
            $soin = Soin::query()->find($item);
            if (isset($soin)) {
                $arrays[] = $soin;

                $total += $soin->price;
            }
        }
        return view('front.cartfinal', [
          //  'soin_id' => $soin_id,
            'soins'=>$arrays,
            'users' => $users
        ]);
    }

    public function calculplaning(Request $request)
    {
        $user_id = $request->get('user_id');
        $soin_id = $request->get('item');
        $date_ = $request->get('date');
        $soin = Soin::find($soin_id);
        $durre = DateTimeHelper::getMin($soin->duree);
        $arry = [];
        if ($user_id == 0) {
            $s = strtotime($date_ . " 08:00:00");
            $e = strtotime($date_ . " 18:00:00");
            $arry[] = date('H:i:s', $s);
            while ($s <= $e) {
                $s = strtotime($durre . ' minutes', $s);
                // echo date('H:i', $s);
                $arry[] = date('H:i:s', $s);
            }
        } else {
            $planing = Planing::query()->where('user_id', '=', $user_id)
                ->where('date_planing', '=', $date_)->first();
            $reservations = Reservation::query()->where('user_id', '=', $user_id)
                ->where('date_reservation', '=', $date_)->get();
            $times = array_map(function ($item) {
                return $item['heure_reservation'];
            }, $reservations->toArray());
            if (isset($planing)) {
                $s = strtotime($date_ . " " . $planing->heure_debut);
                $e = strtotime($date_ . " " . $planing->heure_fin);
                $arry[] = date('H:i:s', $s);
                while ($s <= $e) {
                    $s = strtotime($durre . ' minutes', $s);
                    // echo date('H:i', $s);
                    $arry[] = date('H:i:s', $s);
                }
            }
            $arry = array_filter($arry, function ($item) use ($times) {
                $val = true;
                foreach ($times as $time) {
                    if ($item == $time) {
                        $val = false;
                    }
                    // $this->logger->info("###------###".$time);
                    // $this->logger->info("###---item---###".$item);
                }
                return $val;
                //  return  !array_key_exists($item,$times);
            });

        }


        return response()->json(['data' => $arry, 'status' => true]);
    }

    private function generateTimePlaning()
    {

    }
}
