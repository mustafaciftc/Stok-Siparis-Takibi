<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiparisDetay extends Model
{
    use HasFactory;

    protected $table = 'siparis_detay'; 
    protected $fillable = ['siparis_id', 'stok_id', 'miktar', 'fiyat'];

    // Siparişle ilişkilendirme
    public function siparis()
    {
        return $this->belongsTo(Siparis::class);
    }

    // Stokla ilişkilendirme
    public function stok()
    {
        return $this->belongsTo(Stok::class);
    }
}