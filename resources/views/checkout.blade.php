<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Sepetim</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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

        .payment-method-form {
            display: none;
        }
    </style>
</head>

<body>
    <div class="checkout-container">
        <h2 class="text-center mb-4">Siparişi Tamamla</h2>
        <div class="product-list">
            @foreach($cart as $id => $item)
            <div class="product-item">
                <span class="product-name">{{ $item['urun_adi'] }}</span>
                <span class="product-quantity">Adet: {{ $item['quantity'] }}</span>
                <span class="product-price">{{ number_format($item['fiyat'] * $item['quantity'], 2) }} ₺</span>
            </div>
            @endforeach
        </div>

        <form action="{{ route('checkout.process') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Adınız Soyadınız</label>
                <input type="text" name="customer_name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Telefon</label>
                <input type="tel" name="phone" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">E-posta</label>
                <input type="email" name="email" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Adres</label>
                <textarea name="address" class="form-control" rows="3" required></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Sipariş Notları</label>
                <textarea name="notes" class="form-control" rows="2"></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Ödeme Yöntemi</label>
                <select name="payment_method" id="payment_method" class="form-control" required>
                    <option value="credit_card">Kredi Kartı</option>
                    <option value="paypal">PayPal</option>
                    <option value="cash_on_delivery">Kapıda Ödeme</option>
                </select>
            </div>

            <!-- Kredi Kartı Ödeme Formu -->
            <div id="credit_card_form" class="payment-method-form">
                <div class="mb-3">
                    <label class="form-label">Kart Numarası</label>
                    <input type="text" name="card_number" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Son Kullanma Tarihi</label>
                    <input type="text" name="card_expiry" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">CVV</label>
                    <input type="text" name="card_cvv" class="form-control">
                </div>
            </div>

            <!-- PayPal Ödeme Formu -->
            <div id="paypal_form" class="payment-method-form">
                <div class="mb-3">
                    <label class="form-label">PayPal E-posta</label>
                    <input type="email" name="paypal_email" class="form-control">
                </div>
            </div>

            <!-- Kapıda Ödeme Formu -->
            <div id="cash_on_delivery_form" class="payment-method-form">
                <div class="mb-3">
                    <p>Kapıda ödeme seçeneği ile siparişinizi tamamlayabilirsiniz. Ödeme, teslimat sırasında nakit veya kredi kartı ile yapılabilir.</p>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Kargo Ücreti</label>
                <input type="number" name="shipping_cost" class="form-control" value="1000" min="1000" max="1000" readonly>
            </div>

            <div class="mb-3">
                <div class="d-flex justify-content-between">
                    <h4>Toplam Tutar:</h4>
                    <h4 id="final_total">{{ number_format($total + 1000, 2) }} ₺</h4>
                </div>
            </div>
            <input type="hidden" name="total_amount" value="{{ $total + 1000 }}">
            <button type="submit" class="btn-payment">Ödeme Yap</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const paymentMethodSelect = document.getElementById("payment_method");
            const creditCardForm = document.getElementById("credit_card_form");
            const paypalForm = document.getElementById("paypal_form");
            const cashOnDeliveryForm = document.getElementById("cash_on_delivery_form");

            // Ödeme yöntemine göre formları göster/gizle
            paymentMethodSelect.addEventListener("change", function () {
                const selectedMethod = paymentMethodSelect.value;

                creditCardForm.style.display = selectedMethod === "credit_card" ? "block" : "none";
                paypalForm.style.display = selectedMethod === "paypal" ? "block" : "none";
                cashOnDeliveryForm.style.display = selectedMethod === "cash_on_delivery" ? "block" : "none";
            });

            // Sayfa yüklendiğinde varsayılan ödeme yöntemini göster
            paymentMethodSelect.dispatchEvent(new Event("change"));
        });
    </script>
</body>

</html>