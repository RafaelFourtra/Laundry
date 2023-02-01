<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesanan;
use App\Models\Pelanggan;
use App\Models\Produk;
use App\Models\Outlet;
use App\Models\Detail_Pemesanan;
use App\DataTables\PemesananDataTable;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class PemesananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req,PemesananDataTable $dataTable)
    {   
        
        return $dataTable->render('pemesanan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $produk = Produk::all();
        $pelanggan = Pelanggan::all();
        $outlet = Outlet::all();
        return view('pemesanan.pemesanan-create', ["produk"=>$produk , "pelanggan"=>$pelanggan, "outlet"=>$outlet]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     // dd($request);
        $result = DB::transaction(function () use(&$request){

            $no = Pemesanan::whereDate('pesanan_date', Carbon::today())->count();
            $no ++;
            $no_pesanan = "KUY".date('dmy').str_pad($no,3,0,STR_PAD_LEFT);
            $pemesanan = new Pemesanan();
            $pemesanan->no_pesanan = $no_pesanan;
            $pemesanan->status = "Proses";
            $pemesanan->user_id = auth()->user()->id;
            $pemesanan->pesanan_date = date('Y-m-d');
            $pemesanan->save();

            for ($id_produk = 0; $id_produk < count($request->id_produk); $id_produk++){
                $detail_pemesanan = new Detail_Pemesanan;      
                $detail_pemesanan->id_outlet = $request->id_outlet;
                $detail_pemesanan->id_pelanggan = $request->id_pelanggan;
                $detail_pemesanan->id_jenis = $request->id_produk[$id_produk];
                $detail_pemesanan->jumlah = $request->jumlah[ $id_produk];
                $detail_pemesanan->satuan = $request->satuan[ $id_produk];
                $detail_pemesanan->harga = $request->harga[ $id_produk];
                $detail_pemesanan->total_harga = $request->total_harga[ $id_produk];
                $id_pemesan = $pemesanan->id;
                $detail_pemesanan->id_pemesan = $id_pemesan;
                $detail_pemesanan->save();
                
                }

         
                

        });
     
        $dataTable = new PemesananDataTable;

        return redirect("pemesanan");
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
    public function edit(Pemesanan $pemesanan)
    {
        return view('pemesanan.pemesanan-action', (["pemesanan" => $pemesanan ]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pemesanan $pemesanan)
    {
        $pemesanan->status = $request->status;
        $pemesanan->save();

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
    public function destroy($id)
    {
        //
    }


    public function getdetailpesanan(Request $req){
        $id = Pemesanan::where("no_pesanan", $req->no);
        if($req->has("status")){
            $id = $id->whereIn("status", $req->status);
        }

        if($id->count() < 1){
            return json_encode(null);
        }

        $id = $id->pluck("id")->first();

        
        $pemesanan = Detail_Pemesanan::where("id_pemesan", $id);
        $totalharga = $pemesanan->sum("total_harga");


        $lastoutput = [];

        $json = false;

        

        if($req->has("get")){
            foreach($req->get as $g){
                if($g == "all"){
                    $lastoutput["data"] = $totalharga->get();
                    $lastoutput["total_harga"] = $totalharga;
                }else if($g == "json"){
                    $json = true;
                }
                else if($g == "total_harga"){
                    $lastoutput["total_harga"] = $totalharga;
                }
            }
        }
        
        if($json==true){
            return json_encode($lastoutput);
        }else{
            return $lastoutput;
        }

        

        
    }
}