<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sipariş Listesi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <!-- Geri Butonu -->
        <div class="mb-3">
            <a href="javascript:history.back()" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Geri
            </a>
        </div>

        <h2 class="mb-3">Sipariş Listesi</h2>
      
        <!-- Sipariş Listesi -->
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Müşteri Adı</th>
                    <th>Adres</th>
                    <th>Ödeme Yöntemi</th>
                    <th>Toplam Tutar (₺)</th>
                    <th>Oluşturulma Tarihi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($siparisler as $siparis)
                <tr>
                    <td>{{ $siparis->id }}</td>
                    <td>{{ $siparis->customer_name }}</td>
                    <td>{{ $siparis->address }}</td>
                    <td>
                        @if($siparis->payment_method == 'credit_card')
                            Kredi Kartı
                        @elseif($siparis->payment_method == 'paypal')
                            PayPal
                        @elseif($siparis->payment_method == 'cash_on_delivery')
                            Kapıda Ödeme
                        @else
                            {{ $siparis->payment_method }}
                        @endif
                    </td>
                    <td>{{ number_format($siparis->total_amount, 2, ',', '.') }}</td>
                    <td>{{ date('d-m-Y H:i', strtotime($siparis->created_at)) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
