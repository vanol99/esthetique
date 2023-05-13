<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\helpers;
use App\Http\Controllers\Controller;
use App\Models\Facture;
use App\Models\Soin;
use App\Models\User;
use Illuminate\Http\Request;

class FactureController extends Controller
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
            $agents = Facture::where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->orWhere('f_name', 'like', "%{$value}%")
                        ->orWhere('l_name', 'like', "%{$value}%")
                        ->orWhere('phone', 'like', "%{$value}%")
                        ->orWhere('email', 'like', "%{$value}%");
                }
            });
            $query_param = ['search' => $request['search']];
        } else {
            $agents = new Facture();
        }

        $agents = $agents->latest()->paginate(Helpers::pagination_limit())->appends($query_param);
        return view('back.facturation.index', compact('agents', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $estheticiens=User::query()->estheticien()->get();
        $customers=User::query()->customer()->get();
        $soins=Soin::query()->get();
        return view('back.facturation.create', compact('estheticiens','customers','soins'));
    }
    public function customer(Request $request)
    {
        if ($request->method()=='POST'){
            User::factory()->create([
                "name" => $request->get('firstname'),
                "lastname" => $request->get('lastname'),
                "phone" => $request->get('phone'),
                "adresse" => $request->get('adresse'),
                "email" => $request->get('email'),
                "user_type" => 2,
                "role" => "ROLE_USER",
                'password' => bcrypt($request->get('password')),
            ]);
            return redirect()->route('facturation.create');
        }
        return view('back.facturation.customer');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $facturation=new Facture();
        $soin=Soin::query()->find($request->get('soin_id'));

        $facturation->montantht=$soin->price;
        $facturation->soin_id=$soin->id;
        $facturation->customer_id=$request->get('customer_id');
        $facturation->user_id=$request->get('user_id');
        $facturation->date_facture=date('Y-m-d');
        $facturation->montantttc=$soin->price;
        $facturation->numero=0;
        $facturation->tva=0;
        $facturation->reduction=0;
        $facturation->adresse=012;
        $facturation->save();
      return  redirect()->route('facturation.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(Facture $facture)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $facture=Facture::query()->find($id);
        $estheticiens=User::query()->estheticien()->get();
        $customers=User::query()->customer()->get();
        $soins=Soin::query()->get();
        return view('back.facturation.update', compact('estheticiens','customers','soins','facture'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $facture=Facture::query()->find($id);
        $facture->update([
          'soin_id'=>$request->get('soin_id'),
            'user_id'=>$request->get('user_id'),
            'customer_id'=>$request->get('customer_id'),
        ]);
        return  redirect()->route('facturation.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id=$request->get('item');
        $conge = Facture::query()->find($id);
        $conge->delete();
        return response()->json(['data' => $conge, 'status' => true]);
    }
}
