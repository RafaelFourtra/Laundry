<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Outlet;
use App\DataTables\OutletDataTable;
use App\Http\Requests\OutletRequest;
class OutletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(OutletDataTable $dataTable)
    {
        return $dataTable->render('outlet.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('outlet.outlet-action');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OutletRequest $request)
    {
        Outlet::create($request->all());

        return response()->json([
            'status' => 'success',
            'massage' => 'Create data successfully'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Outlet $outlet)
    {
        return view('outlet.outlet-action', (["outlet" => $outlet ]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OutletRequest $request, Outlet $outlet)
    {
        $outlet->alamat_outlet = $request->alamat_outlet;
        $outlet->kota = $request->kota;
        $outlet->save();

        return response()->json([
            'status' => 'success',
            'massage' => 'Update data successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Outlet $outlet)
    {
        $outlet->delete();

        return response()->json([
            'status' => 'success',
            'massage' => 'Delete data successfully'
        ]);
    }
}
