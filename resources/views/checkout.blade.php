<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Sepetim</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f6f9;
        }
        
        .checkout-container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .btn-payment {
            background-color: #3498db;
            border: none;
            padding: 10px 20px;
            font-weight: 500;
            transition: all 0.3s ease;
            color: white;
            width: 100%;
            border-radius: 8px;
        }
        
        .btn-payment:hover {
            background-color: #2980b9;
        }
        
        .product-list {
            margin-bottom: 20px;
        }
        
        .product-item {
            display: flex;
            justify-content: space-between;
            padding: 10px;
            border-bottom: 1px solid #e9ecef;
        }
        
        .product-item:last-child {
            border-bottom: none;
        }
        
        .product-name {
            font-size: 1.1rem;
            font-weight: 600;
            color: #2c3e50;
        }
        
        .product-price {
            font-size: 1.1rem;
            font-weight: 600;
            color: #3498db;
        }
        
        .product-quantity {
            font-size: 1.1rem;
            font-weight: 600;
            color: #2c3e50;
        }
    </style>
</head>

<body>
    <div class="checkout-container">
        <h2 class="text-center mb-4">Siparişi Tamamla</h2>
        <div class="product-list">
            @foreach($products as $id => $product)
                <div class="product-item">
                    <span class="product-name">{{ $product['urun_adi'] }}</span>
                    <span class="product-quantity">Adet: {{ $product['quantity'] }}</span>
                    <span class="product-price">{{ number_format($product['fiyat'] * $product['quantity'], 2) }} ₺</span>
                </div>
            @endforeach
        </div>
        <div class="cart-total mb-4 text-bg-info text-center text-bold">
            Toplam: <span id="cart-total">{{ number_format($total, 2) }} ₺</span>
        </div>
        <form action="{{ route('checkout.process') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Adınız Soyadınız</label>
                <input type="text" name="customer_name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Adres</label>
                <textarea name="address" class="form-control" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Ödeme Yöntemi</label>
                <select name="payment_method" class="form-control" required>
                    <option value="credit_card">Kredi Kartı</option>
                    <option value="paypal">PayPal</option>
                    <option value="cash_on_delivery">Kapıda Ödeme</option>
                </select>
            </div>

            <input type="hidden" name="total_amount" value="{{ $total }}">
            <button type="submit" class="btn-payment">Ödeme Yap</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>