<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stok Listesi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
 .table {
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        overflow: hidden;
        border: none;
    }

    .table thead th {
        background-color: #2c3e50;
        color: white;
        font-weight: 500;
        padding: 12px;
        border: none;
        text-transform: uppercase;
        font-size: 14px;
    }

    .table td {
        padding: 12px;
        vertical-align: middle;
        border-color: #e9ecef;
    }

    .table tbody tr:hover {
        background-color: #f8f9fa;
        transition: background-color 0.2s ease;
    }

  
    .table img {
        border-radius: 6px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

  .table th, td {
    text-align: center;
  }


    .btn-sm {
        padding: 5px 10px;
        font-size: 13px;
        border-radius: 4px;
        margin: 0 2px;
    }

    .btn-warning {
        background-color: #f39c12;
        border-color: #f39c12;
        color: white;
    }

    .btn-danger {
        background-color: #e74c3c;
        border-color: #e74c3c;
    }

    td:nth-child(4) {
        font-weight: 500;
        color: #2c3e50;
        text-align: right;
        width: 120px;
    }

    td:nth-child(3) {
        text-align: center;
        color: #34495e;
    }

    td:nth-child(2) {
        font-weight: 500;
        color: #2c3e50;
    }

    .text-muted {
        font-size: 13px;
        font-style: italic;
    }

.form-control {
    border-radius: 6px;
    border-color: #dee2e6;
    padding: 8px 12px;
}

.form-control:focus {
    border-color: #3498db;
    box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
}

.btn-primary {
    background-color: #3498db;
    border-color: #3498db;
    padding: 8px 16px;
    font-weight: 500;
}

.btn-primary:hover {
    background-color: #2980b9;
    border-color: #2980b9;
}

@media (max-width: 768px) {
    .container {
        width: 100%;
    }
    .form-control, .btn {
        width: 100%;
    }

    .row.g-3 {
        flex-direction: column;
        gap: 10px;
    }

    .table-responsive {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    .table {
        width: 100%;
    }
}

</style>

<body>
    <div class="container mt-4">
         <!-- Geri Butonu -->
         <div class="mb-3">
            <a href="javascript:history.back()" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Geri
            </a>
        </div>
        <h2 class="mb-3">Stok Listesi</h2>

        <!-- Stok Ekleme Formu -->
        <form method="POST" action="/admin/stok" class="mb-4" enctype="multipart/form-data">            
            @csrf
            <div class="row g-3">
                <div class="col-md-3">
                    <input type="text" name="urun_adi" class="form-control" placeholder="Ürün Adı" required>
                </div>
                <div class="col-md-2">
                    <input type="number" name="miktar" class="form-control" placeholder="Miktar" required>
                </div>
                <div class="col-md-2">
                    <input type="number" step="0.01" name="fiyat" class="form-control" placeholder="Fiyat" required>
                </div>
                <div class="col-md-3">
                    <input type="file" name="img" class="form-control">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">Ekle</button>
                </div>
            </div>
        </form>

        <!-- Stok Listesi -->
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Resim</th>
                    <th>Ürün Adı</th>
                    <th>Stok Sayısı</th>
                    <th>Fiyat</th>
                    <th>İşlemler</th>
                </tr>
            </thead>
            <tbody>
                @foreach($stoklar as $stok)
                    <tr>
                        <td>
                            @if($stok->img)
                                <img src="{{ asset('storage/' . $stok->img) }}" alt="Ürün Resmi" width="80">
                            @else
                                <span class="text-muted">Resim Yok</span>
                            @endif
                        </td>
                        <td>{{ $stok->urun_adi }}</td>
                        <td>{{ $stok->miktar }} adet</td>
                        <td>{{ number_format($stok->fiyat, 2) }} ₺</td>
                        <td>
                            <!-- Düzenle Butonu -->
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                data-bs-target="#editModal{{ $stok->id }}">Düzenle</button>

                            <!-- Silme Butonu -->
                            <form action="{{ route('stok.destroy', $stok->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Bu ürünü silmek istediğinize emin misiniz?')">Sil</button>
                            </form>
                        </td>
                    </tr>

                    <!-- Düzenleme Modali -->
                    <div class="modal fade" id="editModal{{ $stok->id }}" tabindex="-1"
                        aria-labelledby="editModalLabel{{ $stok->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel{{ $stok->id }}">Ürünü Düzenle</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Kapat"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('stok.update', $stok->id) }}" method="POST"
                                        enctype="multipart/form-data"> @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <label class="form-label">Ürün Adı</label>
                                            <input type="text" name="urun_adi" class="form-control"
                                                value="{{ $stok->urun_adi }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Miktar</label>
                                            <input type="number" name="miktar" class="form-control"
                                                value="{{ $stok->miktar }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Fiyat</label>
                                            <input type="number" step="0.01" name="fiyat" class="form-control"
                                                value="{{ $stok->fiyat }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Resim</label>
                                            <input type="file" name="img" class="form-control">
                                        </div>
                                        @if($stok->img)
                                            <div class="mb-3">
                                                <img src="{{ asset('storage/' . $stok->img) }}" alt="Ürün Resmi" width="80">
                                            </div>
                                        @endif
                                        <div class="d-flex align-items-center justify-content-center">
                                            <button type="submit" class="btn btn-success">Güncelle</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-between align-items-center mt-3">
    <div class="text-muted">
        Showing {{ $stoklar->firstItem() }} to {{ $stoklar->lastItem() }} of {{ $stoklar->total() }} results
    </div>
    <ul class="pagination mb-2">
        {{ $stoklar->links('pagination::bootstrap-5') }}
    </ul>
</div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>