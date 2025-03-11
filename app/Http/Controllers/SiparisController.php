<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siparis;
use App\Models\Stok;
use Illuminate\Support\Facades\Auth;

class SiparisController extends Controller
{
    public function index()
    {
        $stoklar = Stok::all();
        $siparisler = Siparis::all();
        return view('admin.siparis', compact( 'siparisler'));
    }

    public function store(Request $request)
    {
        $siparis = Siparis::create([
            'user_id' => Auth::id(),
            'customer_name' => $request->customer_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'notes' => $request->notes,
            'payment_method' => $request->payment_method,
            'payment_status' => $request->payment_status ?? 'pending',
            'order_status' => $request->order_status ?? 'processing',
            'shipping_cost' => $request->shipping_cost ?? 0,
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

        // Kargo ücretini al
        $shipping_cost = $request->shipping_cost ?? 0;

        // Sipariş oluştur
        $order = Siparis::create([
            'user_id' => Auth::id(),
            'customer_name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'notes' => $request->notes,
            'payment_method' => $request->payment_method,
            'payment_status' => 'pending',
            'order_status' => 'processing',
            'shipping_cost' => $shipping_cost,
            'total_amount' => $total + $shipping_cost, 
        ]);

        // Sepetteki her ürün için stok miktarını güncelle
        foreach ($cart as $item) {
            $stok = Stok::where('id', $item['id'])->first(); // Doğru stok kaydını getir
            if ($stok) {
                if ($stok->miktar >= $item['quantity']) { // Stok kontrolü
                    $stok->miktar -= $item['quantity']; // Stok düşürme işlemi
                    $stok->save(); // Güncelleme işlemi
                } else {
                    return redirect()->back()->with('error', 'Stok yetersiz!');
                }
            }
        }

        // Sepeti temizle
        session()->forget('cart');

        return redirect()->route('success', $order);
    }

    public function orderSuccess(Siparis $order)
    {
        return view('success', compact('order'));
    }

    public function guncelle(Request $request, $id)
    {
        $siparis = Siparis::find($id);
        $siparis->order_status = $request->order_status;
        $siparis->save();

        return redirect()->back()->with('success', 'Sipariş durumu güncellendi.');
    }

    public function odemeGuncelle(Request $request, $id)
    {
        $siparis = Siparis::find($id);
        $siparis->payment_status = $request->payment_status;
        $siparis->save();

        return redirect()->back()->with('success', 'Ödeme durumu güncellendi.');
    }
}