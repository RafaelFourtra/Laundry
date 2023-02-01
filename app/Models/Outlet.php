<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Detail_Pemesanan;

class Outlet extends Model
{
    use HasFactory;

    protected $table = 'outlet';
    protected $primaryKey = 'id_outlet';
    protected $guarded = [];


    public function detail_pemesanan()
    {
        return $this->belongsTo(Detail_Pemesanan::class,"id_outlet");
    }
}
