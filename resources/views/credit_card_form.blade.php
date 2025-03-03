<!DOCTYPE html>
<html lang="tr">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Kredi Kartı Ödemesi</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
     <style>
          body {
               background-color: #f4f6f9;
          }

          .payment-container {
               max-width: 600px;
               margin: 50px auto;
               padding: 20px;
               background-color: white;
               border-radius: 10px;
               box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
          }

          .credit-card-box {
               padding: 20px;
               border: 1px solid #e9ecef;
               border-radius: 10px;
               margin-bottom: 20px;
          }

          .card-header {
               display: flex;
               justify-content: space-between;
               align-items: center;
               margin-bottom: 20px;
          }

          .card-header img {
               height: 30px;
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
               margin-top: 20px;
          }

          .btn-payment:hover {
               background-color: #2980b9;
          }
     </style>
</head>

<body>
     <div class="payment-container">
          <h2 class="text-center mb-4">Kredi Kartı ile Ödeme</h2>

          <div class="order-summary mb-4">
               <h5>Sipariş Özeti</h5>
               <p>Sipariş Numarası: <strong>{{ $order->id }}</strong></p>
               <p>Toplam Tutar: <strong>{{ number_format($order->total_amount, 2) }} ₺</strong></p>
          </div>

          <div class="credit-card-box">
               <div class="card-header">
                    <h5>Kart Bilgileri</h5>
                    <div class="card-logos">
                         <img src="https://cdn.jsdelivr.net/gh/aaronfagan/svg-credit-card-payment-icons@main/logo/visa.svg"
                              alt="Visa">
                         <img src="https://cdn.jsdelivr.net/gh/aaronfagan/svg-credit-card-payment-icons@main/logo/mastercard.svg"
                              alt="Mastercard">
                    </div>
               </div>

               <form id="payment-form" action="{{ route('payment.process') }}" method="POST">
                    @csrf
                    <input type="hidden" name="order_id" value="{{ $order->id }}">

                    <div class="mb-3">
                         <label for="cardHolderName" class="form-label">Kart Üzerindeki İsim</label>
                         <input type="text" class="form-control" id="cardHolderName" name="card_holder_name" required>
                    </div>

                    <div class="mb-3">
                         <label for="cardNumber" class="form-label">Kart Numarası</label>
                         <input type="text" class="form-control" id="cardNumber" name="card_number" maxlength="19"
                              placeholder="XXXX XXXX XXXX XXXX" required>
                    </div>

                    <div class="row">
                         <div class="col-md-6 mb-3">
                              <label for="expiryDate" class="form-label">Son Kullanma Tarihi</label>
                              <input type="text" class="form-control" id="expiryDate" name="expiry_date"
                                   placeholder="AA/YY" maxlength="5" required>
                         </div>

                         <div class="col-md-6 mb-3">
                              <label for="cvv" class="form-label">CVV</label>
                              <input type="text" class="form-control" id="cvv" name="cvv" maxlength="3" required>
                         </div>
                    </div>

                    <button type="submit" class="btn-payment">Ödemeyi Tamamla</button>
               </form>
          </div>

          <div class="text-center mt-3">
               <a href="{{ route('checkout.show') }}" class="btn btn-outline-secondary">Geri Dön</a>
          </div>
     </div>

     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
     <script>
          // Credit card number formatting
          document.getElementById('cardNumber').addEventListener('input', function (e) {
               let value = e.target.value.replace(/\s+/g, '').replace(/[^0-9]/gi, '');
               let formattedValue = '';

               for (let i = 0; i < value.length; i++) {
                    if (i > 0 && i % 4 === 0) {
                         formattedValue += ' ';
                    }
                    formattedValue += value[i];
               }

               e.target.value = formattedValue;
          });

          // Expiry date formatting
          document.getElementById('expiryDate').addEventListener('input', function (e) {
               let value = e.target.value.replace(/\s+/g, '').replace(/[^0-9]/gi, '');

               if (value.length > 2) {
                    e.target.value = value.slice(0, 2) + '/' + value.slice(2);
               } else {
                    e.target.value = value;
               }
          });
     </script>
</body>

</html>