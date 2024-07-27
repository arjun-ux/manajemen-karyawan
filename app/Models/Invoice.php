<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Invoice extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function pembayaran(): HasMany
    {
        return $this->hasMany(Pembayaran::class);
    }
    public function saba()
    {
        return $this->belongsTo(Saba::class);
    }
    public function invoice():HasMany
    {
        return $this->hasMany(Invoice::class);
    }
}
