<?php

namespace Database\Seeders;

use App\Models\Stok;
use Illuminate\Database\Seeder;

class StokSeeder extends Seeder
{
    public function run()
    {
        $products = [
            ['urun_adi' => 'Tablet', 'miktar' => 10, 'fiyat' => 300.00],
            ['urun_adi' => 'Laptop', 'miktar' => 15, 'fiyat' => 1500.00],
            ['urun_adi' => 'Kamera', 'miktar' => 12, 'fiyat' => 500.00],
            ['urun_adi' => 'Kulaklık', 'miktar' => 20, 'fiyat' => 150.00],
            ['urun_adi' => 'Çanta', 'miktar' => 25, 'fiyat' => 75.00],
            ['urun_adi' => 'Akıllı Saat', 'miktar' => 30, 'fiyat' => 250.00],
            ['urun_adi' => 'Televizyon', 'miktar' => 5, 'fiyat' => 2500.00],
            ['urun_adi' => 'Mikrofon', 'miktar' => 8, 'fiyat' => 100.00],
            ['urun_adi' => 'Klavyeli Mouse', 'miktar' => 10, 'fiyat' => 120.00],
            ['urun_adi' => 'Projeor', 'miktar' => 6, 'fiyat' => 800.00],
            ['urun_adi' => 'USB Bellek', 'miktar' => 50, 'fiyat' => 40.00],
            ['urun_adi' => 'Powerbank', 'miktar' => 35, 'fiyat' => 70.00],
            ['urun_adi' => 'Web Kamera', 'miktar' => 18, 'fiyat' => 130.00],
            ['urun_adi' => 'Klavye', 'miktar' => 22, 'fiyat' => 90.00],
            ['urun_adi' => 'Telefon Kılıfı', 'miktar' => 40, 'fiyat' => 25.00],
            ['urun_adi' => 'Ekran Kartı', 'miktar' => 4, 'fiyat' => 1200.00],
            ['urun_adi' => 'Oyun Konsolu', 'miktar' => 8, 'fiyat' => 1800.00],
            ['urun_adi' => 'Laptop Çantası', 'miktar' => 50, 'fiyat' => 60.00],
        ];

        foreach ($products as $product) {
            Stok::create($product);
        }
    }
}

