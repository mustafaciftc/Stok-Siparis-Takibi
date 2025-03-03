<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stok;

class CartController extends Controller
{
    public function index()
    {
        return view('cart');
    }

    public function addToCart($id)
    {
        $stok = Stok::findOrFail($id);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "urun_adi" => $stok->urun_adi,
                "quantity" => 1,
                "fiyat" => $stok->fiyat,
                "img" => $stok->img
            ];
        }

        session()->put('cart', $cart);
        return redirect()->route('cart')->with('success', 'Ürün sepete eklendi!');
    }

    public function update(Request $request)
    {
        if($request->id && $request->quantity) {
            $cart = session()->get('cart');
            $cart[$request->id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
            
            // Toplam sepet tutarını hesapla
            $cartTotal = 0;
            foreach($cart as $item) {
                $cartTotal += $item['fiyat'] * $item['quantity'];
            }
            
            return response()->json([
                'itemPrice' => $cart[$request->id]['fiyat'],
                'quantity' => $cart[$request->id]['quantity'],
                'cartTotal' => $cartTotal
            ]);
        }
    }
    
    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            
            // Toplam sepet tutarını hesapla
            $cartTotal = 0;
            foreach($cart as $item) {
                $cartTotal += $item['fiyat'] * $item['quantity'];
            }
            
            return response()->json([
                'cartTotal' => $cartTotal,
                'cartCount' => count($cart)
            ]);
        }
    }
}