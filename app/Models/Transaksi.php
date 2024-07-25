<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function saba(){
        return $this->belongsTo(Saba::class);
    }

    public function invoice(){
        return $this->belongsTo(Invoice::class, 'tagihan_id','id');
    }
}
