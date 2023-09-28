<?php

namespace App\Models;

use App\Models\Foodmenu;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaksipembelian extends Model
{
    use HasFactory;
    protected $table = 'transaksi_pembelians';
    protected $guarded = ['id'];

    public function foodmenu()
    {
        return  $this->belongsTo(Foodmenu::class);
    }
}
