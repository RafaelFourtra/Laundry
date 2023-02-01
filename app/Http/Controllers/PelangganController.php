<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;
use App\DataTables\PelangganDataTable;
use App\Http\Requests\PelangganRequest;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PelangganDataTable $dataTable)
    {
        return $dataTable->render("pelanggan.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pelanggan.pelanggan-action');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PelangganRequest $request)
    {
        Pelanggan::create($request->all());

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
    public function edit(Pelanggan $pelanggan)
    {
        return view('pelanggan.pelanggan-action', ["pelanggan" => $pelanggan]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PelangganRequest $request, Pelanggan $pelanggan)
    {
        $pelanggan->nama_pelanggan = $request->nama_pelanggan;
        $pelanggan->contact_pelanggan = $request->contact_pelanggan;
        $pelanggan->alamat_pelanggan = $request->alamat_pelanggan;
        $pelanggan->riwayat_order = $request->riwayat_order;
        $pelanggan->save();

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
    public function destroy(Pelanggan $pelanggan)
    {
        $pelanggan->delete();
        return response()->json([
            'status' => 'success',
            'massage' => 'Delete data successfully'
        ]);
    }
}
