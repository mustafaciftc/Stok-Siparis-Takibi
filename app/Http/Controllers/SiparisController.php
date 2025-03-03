<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siparis;
use App\Models\SiparisItem;
use App\Models\Stok;
use Illuminate\Support\Facades\Auth;

class SiparisController extends Controller
{
    public function index()
    {
        $stoklar = Stok::all();
        $siparisler = Siparis::all();    
        return view('admin.siparis', compact('stoklar', 'siparisler'));

    }

    public function store(Request $request)
    {
        $siparis = Siparis::create([
            'user_id' => Auth::id(),
            'customer_name' => $request->customer_name,
            'address' => $request->address,
            'payment_method' => $request->payment_method,
            'total_amount' => $request->total_amount,
        ]);

        return redirect()->route('order.success', $siparis);
    }

    public function showCheckout()
    {
        $cart = session('cart', []);
        $total = array_sum(array_map(function ($item) {
            return $item['fiyat'] * $item['quantity'];
        }, $cart));

        return view('checkout', compact('cart', 'total'));
    }

    public function processCheckout(Request $request)
    {
        $cart = session('cart', []);
        $total = array_sum(array_map(function ($item) {
            return $item['fiyat'] * $item['quantity'];
        }, $cart));

        // Sipariş oluştur
        $order = Siparis::create([
            'user_id' => Auth::id(),
            'customer_name' => $request->name,
            'address' => $request->address,
            'payment_method' => $request->payment_method,
            'total_amount' => $total,
        ]);
    
        // Sepeti temizle
        session()->forget('cart');

        return redirect()->route('order.success', $order);
    }

    public function orderSuccess(Siparis $order)
    {
        return view('order_success', compact('order'));
    }
}