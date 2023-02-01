<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Detail_Pemesan;
use App\Models\Transaksi;

class Pemesanan extends Model
{
    use HasFactory;

    protected $table = 'pesanan';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function detail_pesanan()
    {
        return $this->hasMany(Detail_Pemesanan::class,"id_pemesan");
    }
    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class,"no_pesanan");
    }

}
