<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\helpers;
use App\Http\Controllers\Controller;
use App\Models\Fournisseur;
use App\Models\Product;
use App\Models\Product_type;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
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
            $agents = Product::where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->orWhere('f_name', 'like', "%{$value}%")
                        ->orWhere('l_name', 'like', "%{$value}%")
                        ->orWhere('phone', 'like', "%{$value}%")
                        ->orWhere('email', 'like', "%{$value}%");
                }
            });
            $query_param = ['search' => $request['search']];
        } else {
            $agents = new Product();
        }

        $agents = $agents->latest()->paginate(Helpers::pagination_limit())->appends($query_param);
        $fournisseurs=Fournisseur::all();
        $categories=Product_type::all();
        return view('back.product.index', compact('agents', 'search','categories','fournisseurs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.caisse.create', []);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'libelle' => 'required',
            //'image' => 'required',
            'price_sell' => 'required',
            'price' => 'required',
            'quantite' => 'required',
            'product_type_id' => 'required',
        ]);

        $email = $request->email;
        $agent = Product::where(['libelle' => $email])->first();
        if (isset($agent)){
            //  Toastr::warning(translate('This phone number is already taken'));
            return back();
        }

        DB::transaction(function () use ($request, $email) {
            $user = new Product();
            $user->libelle = $request->libelle;
            $user->quantite = $request->quantite;
            $user->image = Helpers::upload('product/', 'png', $request->file('image'));
            $user->description = $request->description;
            $user->price_sell = $request->price_sell;
            $user->price = $request->price;
            $user->product_type_id = $request->product_type_id;
            $user->fournisseur_id = isset($request->fournisseur_id)?$request->fournisseur_id:null;
            $user->save();
        });

        // Toastr::success(translate('Agent Added Successfully!'));
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $fournisseurs=Fournisseur::all();
        $categories=Product_type::all();
        return view('back.product.update', compact('product','fournisseurs','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $conge = Product::find($id);
        $conge->update([
            'libelle' => $request->libelle,
            'description' => $request->description,
            'quantite' => $request->quantite,
            'image' => is_null($request->file('image'))?$conge->image:Helpers::upload('product/', 'png', $request->file('image')),
        'price_sell' => $request->price_sell,
            'price' => $request->price,
        ]);
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id=$request->get('item');
        $conge = Product::query()->find($id);
        $conge->delete();
        return response()->json(['data' => $conge, 'status' => true]);
    }
}
