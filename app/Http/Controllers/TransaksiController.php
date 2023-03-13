<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Pemesanan;
use App\Models\Detail_Pemesanan;
use App\DataTables\TransaksiDataTable;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TransaksiDataTable $dataTable)
    {
        $pemesanan = Pemesanan::whereIn("status", ["Proses"])->get();
        return $dataTable->render('transaksi.index', ["pemesanan"=>$pemesanan]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $transaksi = new Transaksi();
        $transaksi->no_pesanan = $request->no_pesanan;
        $transaksi->pembayaran = $request->pembayaran;
        $transaksi->kembalian = $request->kembalian;
        $transaksi->transaksi_date = date('Y-m-d');
        if ($request->has('diskon') && $request->diskon != '') {
            $transaksi->diskon = $request->diskon;
        } else {
            $transaksi->diskon = 0;
        }
        $transaksi->transaksi_jumlah = $request->transaksi_jumlah;




        $transaksi->save();


        //Ubah status
        Pemesanan::where("no_pesanan", $request->no_pesanan)->update(["status" => "Selesai"]);

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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getpesanandetail(Request $request){
        $idpesanan = Pemesanan::where("no_pesanan", $request->no_pesanan)->pluck("id")->first();
         $data = Detail_Pemesanan::where("id_pemesan", $idpesanan)->with("produk")->get();

        return json_encode($data);
    }
}