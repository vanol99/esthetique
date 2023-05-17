<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\helpers;
use App\Http\Controllers\Controller;
use App\Models\Fournisseur;
use App\Models\Product;
use App\Models\Product_type;
use App\Models\Soin;
use App\Models\Soin_type;
use App\Models\User;
use Illuminate\Http\Request;

class SoinController extends Controller
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
            $agents = Soin::where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->orWhere('libelle', 'like', "%{$value}%")
                        ->orWhere('description', 'like', "%{$value}%")
                        ->orWhere('price', 'like', "%{$value}%");
                }
            });
            $query_param = ['search' => $request['search']];
        } else {
            $agents = new Soin();
        }

        $agents = $agents->newQuery()->latest()->paginate(Helpers::pagination_limit())->appends($query_param);
        $soin_types=Soin_type::all();
        return view('back.soin.index', compact('agents', 'search','soin_types'));
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
        $request->validate([
            'libelle' => 'required',
            'price' => 'required',
            'duree' => 'required',
            'soin_type_id' => 'required',
        ]);
        $conge_=Soin::query()->where('libelle','=',$request->libelle)
            ->where('price','=',$request->price)
            ->where('soin_type_id','=',$request->soin_type_id)->first();
        if (isset($conge_)){
            //  Toastr::warning(translate('This phone number is already taken'));
            return back();
        }
        $conge = new Soin();
        $conge->libelle = $request->libelle;
        $conge->description = $request->description;
        $conge->price = $request->price;
        $conge->duree = $request->duree;
        $conge->soin_type_id = $request->soin_type_id;
        $conge->save();
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Soin $soin)
    {
        return view('back.soin.index', []);
    }

    /**
     * Show the form for editing the specified resource.
     * @param Soin $soin
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function edit($id)
    {
        $soin = Soin::find($id);
        $soin_types=Soin_type::all();
        return view('back.soin.update', ['soin'=>$soin,'soin_types'=>$soin_types]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $conge = Soin::find($id);
        $conge->update([
            'libelle' => $request->libelle,
            'price' => $request->price,
            'duree' => $request->duree,
            'soin_type_id' => $request->soin_type_id,
        ]);
        return redirect()->route('soin.index');
    }
    public function product(Request $request,$id)
    {
        $soin= Soin::query()->find($id);
        $produts=Product::all();
        if ($request->method()=="POST"){
            $product=Product::query()->find($request->product_id);
            $soin->products()->attach($request->product_id);
        }
        return view('back.soin.product', [
            'soin'=>$soin,
            'products'=>$produts
        ]);
    }
    public function removeproduct(Request $request){
        $soin= Soin::query()->find($request->get('soin_id'));
        $soin->products()->detach($request->product_id);
        return redirect()->route('soin.product',['id'=>$soin->id]);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id=$request->get('item');
        $conge = Soin::query()->find($id);
        $conge->delete();
        return response()->json(['data' => $conge, 'status' => true]);
    }
}
