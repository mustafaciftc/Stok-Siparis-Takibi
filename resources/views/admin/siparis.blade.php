<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sipariş Listesi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .table-container {
            overflow-x: auto;
        }
        
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .table th, .table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            white-space: nowrap;
        }
        
        .table th {
            background-color: #222222;
            font-weight: 600;
        }
        
        .table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        
        .table tbody tr:hover {
            background-color: #e0e0e0;
        }
        
        .form-control {
            width: 150px; 
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
    </style>
</head>
    @if(Auth::check() && Auth::user()->role == 0)
    <script>window.location.href = "/";</script>
    <?php exit; ?>
@endif
<body>
    <div class="container mt-4">
        <div class="mb-3">
            <a href="/admin" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Geri
            </a>
        </div>

        <h2 class="mb-3">Sipariş Listesi</h2>
        
        <div class="table-container">
            <table class="table">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Müşteri Adı</th>
                        <th>Telefon</th>
                        <th>E-posta</th>
                        <th>Adres</th>
                        <th>Ödeme Yöntemi</th>
                        <th>Toplam Tutar (₺)</th>
                        <th>Oluşturulma Tarihi</th>
                        <th>Notlar</th>
                        <th>Sipariş Durumu</th>
                        <th>Ödeme Durumu</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($siparisler as $siparis)
                    <tr>
                        <td>{{ $siparis->id }}</td>
                        <td>{{ $siparis->customer_name }}</td>
                        <td>{{ $siparis->phone }}</td>
                        <td>{{ $siparis->email }}</td>
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
                        <td>{{ $siparis->notes }}</td>
                        <td>
                            <form action="{{ route('siparis.guncelle', $siparis->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <select name="order_status" class="form-control" onchange="this.form.submit()">
                                    <option value="processing" {{ $siparis->order_status == 'processing' ? 'selected' : '' }}>İşleniyor</option>
                                    <option value="shipped" {{ $siparis->order_status == 'shipped' ? 'selected' : '' }}>Kargolandı</option>
                                    <option value="delivered" {{ $siparis->order_status == 'delivered' ? 'selected' : '' }}>Teslim Edildi</option>
                                    <option value="cancelled" {{ $siparis->order_status == 'cancelled' ? 'selected' : '' }}>İptal Edildi</option>
                                </select>
                            </form>
                        </td>
                        <td>
                            <form action="{{ route('siparis.odeme.guncelle', $siparis->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <select name="payment_status" class="form-control" onchange="this.form.submit()">
                                    <option value="pending" {{ $siparis->payment_status == 'pending' ? 'selected' : '' }}>Bekliyor</option>
                                    <option value="paid" {{ $siparis->payment_status == 'paid' ? 'selected' : '' }}>Ödendi</option>
                                    <option value="failed" {{ $siparis->payment_status == 'failed' ? 'selected' : '' }}>Başarısız</option>
                                </select>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
