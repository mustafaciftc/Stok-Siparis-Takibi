<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Siparis extends Model
{
    use HasFactory;

    protected $table = 'siparis'; 

    protected $fillable = [
        'user_id',
        'customer_name',
        'phone',
        'email',
        'address',
        'notes',
        'payment_method',
        'payment_status',
        'order_status',
        'shipping_cost',
        'total_amount',
    ];

    // Siparişi oluşturan kullanıcıyla ilişkilendirme
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    

}
