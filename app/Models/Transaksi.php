<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function pesanan()
    {
        return $this->hasOne(Pemesanan::class,"no_pesanan");
    } 
}
