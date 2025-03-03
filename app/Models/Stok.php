<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stok extends Model
{
    use HasFactory;
    protected $fillable = ['urun_adi', 'miktar', 'fiyat', 'img'];

    public function siparisler()
    {
        return $this->hasMany(Siparis::class);
    }
}
