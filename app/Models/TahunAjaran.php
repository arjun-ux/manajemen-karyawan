<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahunAjaran extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function Pembayaran()
    {
        return $this->belongsTo(Pembayaran::class);
    }
}
