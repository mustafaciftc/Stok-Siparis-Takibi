<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\SiparisItem; // Doğru yolu kullanın

class Siparis extends Model
{
    use HasFactory;

    protected $table = 'siparis'; // Tablo adını belirtiyoruz

    protected $fillable = [
        'user_id',
        'customer_name',
        'address',
        'payment_method',
        'total_amount',
    ];

    // Siparişi oluşturan kullanıcıyla ilişkilendirme
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    

}
