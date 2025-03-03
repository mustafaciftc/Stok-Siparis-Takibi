<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sipariş Başarılı</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
        <div class="alert alert-success">
            <h4 class="alert-heading">Siparişiniz Başarıyla Alındı!</h4>
            <p>Sipariş numaranız: <strong>{{ $order->id }}</strong></p>
            <p>Toplam Tutar: <strong>{{ number_format($order->total_amount, 2) }} ₺</strong></p>
            <p>Ödeme Yöntemi: <strong>{{ $order->payment_method }}</strong></p>
            <hr>
            <p class="mb-0">Siparişiniz en kısa sürede kargoya verilecektir.</p>
        </div>
        <a href="{{ route('home') }}" class="btn btn-primary">Anasayfaya Dön</a>
    </div>
</body>
</html>