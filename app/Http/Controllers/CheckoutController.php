<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siparis;
use App\Models\SiparisItem;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    /**
     * Show the checkout page with cart data
     */
    public function show(Request $request)
    {
        // Sepet verilerini session'dan al
        $cart = session('cart', []);

        // Toplam tutarı hesapla
        $total = array_reduce($cart, function ($sum, $item) {
            return $sum + ($item['fiyat'] * $item['quantity']);
        }, 0);

        return view('checkout', ['products' => $cart, 'total' => $total]);
    }

    /**
     * Process the payment and complete the order
     */
    public function process(Request $request)
    {
        // Form doğrulama
        $request->validate([
            'customer_name' => 'required|string',
            'address' => 'required|string',
            'payment_method' => 'required|string',
        ]);

        // Sepet verilerini session'dan al
        $cart = session('cart', []);

        // Toplam tutarı hesapla
        $total = array_reduce($cart, function ($sum, $item) {
            return $sum + ($item['fiyat'] * $item['quantity']);
        }, 0);

        // Siparişi veritabanına kaydet
        $siparis = Siparis::create([
            'user_id' => Auth::id(), // Giriş yapan kullanıcının ID'si
            'customer_name' => $request->input('customer_name'), // Müşteri adı
            'address' => $request->input('address'), // Teslimat adresi
            'payment_method' => $request->input('payment_method'), // Ödeme yöntemi
            'total_amount' => $total, // Toplam tutar
        ]);

        // Sepeti temizle
        session()->forget('cart');

        // Sipariş başarılı sayfasına yönlendir
        return redirect()->route('checkout.success', ['order' => $siparis->id]);    }

    /**
     * Show the success page
     */
    public function success($orderId)
    {
        $order = Siparis::find($orderId);
    
        if (!$order) {
            return redirect()->route('home');
        }
    
        return view('success', ['order' => $order]);
    }

}