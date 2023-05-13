<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\helpers;
use App\Http\Controllers\Controller;
use App\Models\Soin;
use App\Models\Soin_type;
use App\Models\User;
use Illuminate\Http\Request;

class TypeSoinController extends Controller
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
            $agents = Soin_type::where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->orWhere('libelle', 'like', "%{$value}%");
                }
            });
            $query_param = ['search' => $request['search']];
        } else {
            $agents = new Soin_type();
        }

        $agents = $agents->newQuery()->latest()->paginate(Helpers::pagination_limit())->appends($query_param);

        return view('back.typesoin.index', compact('agents', 'search'));
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
        ]);
        $conge_=soin_type::query()->where('libelle','=',$request->libelle)->first();
        if (isset($conge_)){
            //  Toastr::warning(translate('This phone number is already taken'));
            return back();
        }
        $conge = new soin_type();
        $conge->libelle = $request->libelle;
        $conge->save();
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Soin $soin)
    {
        return view('back.typesoin.index', []);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $soin = Soin_type::find($id);
        return view('back.typesoin.update', compact('soin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
       $typesoin=Soin_type::query()->find($id);
       $typesoin->update([
           'libelle'=>$request->get('libelle')
       ]);
      return redirect()->route('typesoin.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id=$request->get('item');
        $conge = Soin_type::query()->find($id);
        $conge->delete();
        return response()->json(['data' => $conge, 'status' => true]);
    }
}
