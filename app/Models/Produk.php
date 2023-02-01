<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Detail_Pemesanan;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';
    protected $primaryKey = 'id_produk';
    protected $guarded = [];


    public function detail_pemesanan()
    {
        return $this->belongsTo(Detail_Pemesanan::class,"id_produk");
    }
}
