<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PackageRequest;
use App\Models\Package;
use App\Repository\PricingRepository;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.package.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.package.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PackageRequest $request)
    {
        $package = Package::create($request->all());
        PricingRepository::put($package->id, $request->pricings);

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
        $package = Package::findOrFail($id);

        return view('admin.package.edit', compact('package'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PackageRequest $request, $id)
    {
        Package::findOrFail($id)->update($request->all());
        PricingRepository::put($id, $request->pricings);

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
        Package::destroy($id);
        return back()->with('alert_s', 'Berhasil menghapus paket');
    }

    public function datatables()
    {
        return datatables()
            ->of(Package::query())
            ->addIndexColumn()
            ->addColumn('delUrl', fn($pkg) => route('admin.packages.destroy', $pkg->id))
            ->addColumn('editUrl', fn($pkg) => route('admin.packages.edit', $pkg->id))
            ->make(true);
    }
}
