<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siparis;
use App\Models\SiparisDetay;
use App\Models\Stok;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    // Checkout sayfasını göster
    public function show()
    {
        // Sepet bilgilerini al
        $cart = session()->get('cart', []);
        
        // Sepet boşsa ana sayfaya yönlendir
        if (empty($cart)) {
            return redirect()->route('urunler')->with('error', 'Sepetiniz boş.');
        }

        // Toplam sepet tutarını hesapla
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['fiyat'] * $item['quantity'];
        }

        // Checkout sayfasını göster
        return view('checkout', compact('cart', 'total'));
    }

    // Siparişi işle
public function process(Request $request)
{
    // Formdan gelen verileri doğrula
    $request->validate([
        'customer_name' => 'required|string|max:255',
        'phone' => 'nullable|string|max:20',
        'email' => 'nullable|email|max:255',
        'address' => 'required|string|max:255',
        'notes' => 'nullable|string',
        'payment_method' => 'required|string|max:255',
        'shipping_cost' => 'nullable|numeric|min:0',
    ]);

    // Sepet bilgilerini al
    $cart = session()->get('cart', []);

    // Sepet boşsa hata mesajı göster
    if (empty($cart)) {
        return redirect()->route('urunler')->with('error', 'Sepetiniz boş.');
    }

    // Kargo ücretini al
    $shipping_cost = $request->input('shipping_cost', 0);

    // Yeni bir sipariş oluştur
    $siparis = new Siparis();
    $siparis->user_id = Auth::id(); // Giriş yapan kullanıcının ID'si
    $siparis->customer_name = $request->input('customer_name');
    $siparis->phone = $request->input('phone');
    $siparis->email = $request->input('email');
    $siparis->address = $request->input('address');
    $siparis->notes = $request->input('notes');
    $siparis->payment_method = $request->input('payment_method');
    $siparis->payment_status = 'pending'; // Başlangıç durumu
    $siparis->order_status = 'processing'; // Başlangıç durumu
    $siparis->total_amount = 0; // Başlangıçta toplam tutar 0
    $siparis->shipping_cost = $shipping_cost;
    $siparis->save();

    // Toplam tutarı hesapla ve sipariş detaylarını kaydet
    $toplamTutar = 0;
    foreach ($cart as $id => $item) {
        // Sipariş detaylarını kaydet
        $siparisDetay = new SiparisDetay();
        $siparisDetay->siparis_id = $siparis->id;
        $siparisDetay->stok_id = $id;
        $siparisDetay->miktar = $item['quantity'];
        $siparisDetay->fiyat = $item['fiyat'];
        $siparisDetay->save();

        // Toplam tutarı güncelle
        $toplamTutar += $item['fiyat'] * $item['quantity'];

        // Stoktan düşürme işlemi
        $stok = Stok::find($id);
        if ($stok) {
            $stok->miktar -= $item['quantity'];
            $stok->save();
        }
    }

    // Siparişin toplam tutarını güncelle (kargo ücreti dahil)
    $siparis->total_amount = $toplamTutar + $shipping_cost;
    $siparis->save();

    // Sepeti temizle
    session()->forget('cart');

    // Kullanıcıyı sipariş başarılı sayfasına yönlendir
    return redirect()->route('checkout.success', ['order' => $siparis->id])->with('success', 'Siparişiniz başarıyla oluşturuldu!');
}

    // Sipariş başarılı sayfasını göster
    public function success(Siparis $order)
    {
        // Sipariş bilgilerini kontrol et
        if ($order->user_id !== Auth::id()) {
            return redirect()->route('urunler')->with('error', 'Geçersiz sipariş.');
        }

        // Sipariş başarılı sayfasını göster
        return view('success', compact('order'));
    }
}