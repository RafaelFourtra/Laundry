<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Produk;
use App\Models\Pelanggan;
use App\Models\Outlet;

class Detail_Pemesanan extends Model
{
    use HasFactory;

    protected $table = 'detail_pesanan';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function pelanggan() 
    {
        return $this->belongsTo(Pelanggan::class,'id_pelanggan');
    }

    public function produk() 
    {
        return $this->hasOne(Produk::class,'id_produk',"id_jenis");
    }

    public function outlet() 
    {
        return $this->hasMany(Outlet::class,'id_outlet');
    }
}
