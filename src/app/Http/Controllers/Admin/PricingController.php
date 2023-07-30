<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PricingRequest;
use App\Models\Pricing;
use Illuminate\Http\Request;

class PricingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pricing.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pricing.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PricingRequest $request)
    {
        Pricing::create($request->all());
        return back()->with('alert_s', 'Berhasil menambahkan paket');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pricing = Pricing::findOrFail($id);

        return view('admin.pricing.edit', compact('pricing'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PricingRequest $request, $id)
    {
        Pricing::findOrFail($id)->update($request->all());

        return back()->with('alert_s', 'Berhasil mengubah paket');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Pricing::destroy($id);
        return back()->with('alert_s', 'Berhasil menghapus paket');
    }

    public function datatables()
    {
        return datatables()
            ->of(Pricing::query())
            ->addIndexColumn()
            ->addColumn('delUrl', fn($prc) => route('admin.pricings.destroy', $prc->id))
            ->addColumn('editUrl', fn($prc) => route('admin.pricings.edit', $prc->id))
            ->make(true);
    }
}
