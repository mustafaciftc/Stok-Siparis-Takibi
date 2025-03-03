<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sepetim - Stok ve Sipariş Sistemi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f4f6f9;
        }

        .navbar {
            background-color: #2c3e50;
        }

        .navbar-brand,
        .nav-link {
            color: white !important;
        }

        .nav-link:hover {
            color: #3498db !important;
        }

        .cart-container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .cart-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px;
            border-bottom: 1px solid #e9ecef;
        }

        .cart-item:last-child {
            border-bottom: none;
        }

        .cart-item img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
        }

        .cart-item-details {
            flex: 1;
            margin-left: 20px;
        }

        .cart-item-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #2c3e50;
        }

        .cart-item-price {
            font-size: 1.2rem;
            font-weight: 700;
            color: #3498db;
        }

        .cart-item-quantity {
            display: flex;
            align-items: center;
        }

        .cart-item-quantity input {
            width: 60px;
            text-align: center;
            margin: 0 10px;
        }

        .cart-total {
            font-size: 1.4rem;
            font-weight: 700;
            color: #2c3e50;
            text-align: right;
            margin-top: 20px;
        }

        .btn-checkout {
            background-color: #3498db;
            border: none;
            padding: 10px 20px;
            font-weight: 500;
            transition: all 0.3s ease;
            color: white;
            width: 100%;
            border-radius: 8px;
        }

        .btn-checkout:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
        }

        /* Style for the back button */
        .back-btn {
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: flex-start;
        }

        .back-btn a {
            color: #fff;
            background-color: #2c3e50;
            padding: 10px 15px;
            border-radius: 5px;
            text-decoration: none;
        }

        .back-btn a:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>

<!-- Cart Container -->
<div class="cart-container">
    <!-- Back Button -->
    <div class="back-btn">
        <a href="javascript:history.back()" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Geri
        </a>
    </div>
    
    <h2 class="text-center mb-4">Sepetim</h2>
    <div id="cart-items">
        @if(session('cart'))
            <form action="{{ route('checkout.show') }}" method="POST">
                @csrf
                @foreach(session('cart') as $id => $details)
                    <div class="cart-item" data-id="{{ $id }}">
                        <img src="{{ asset('storage/' . $details['img']) }}" alt="{{ $details['urun_adi'] }}">
                        <div class="cart-item-details">
                            <div class="cart-item-title">{{ $details['urun_adi'] }}</div>
                            <div class="cart-item-price" data-price="{{ $details['fiyat'] }}">
                                {{ number_format($details['fiyat'], 2) }} ₺
                            </div>
                        </div>
                        <div class="cart-item-quantity">
                            <input type="number" value="{{ $details['quantity'] }}" class="form-control quantity"
                                   data-id="{{ $id }}" name="products[{{ $id }}][quantity]">
                            <button class="btn btn-primary btn-sm update-quantity" style="margin-right: 3px;" data-id="{{ $id }}" type="button">Güncelle</button>
                        </div>
                        <button class="btn btn-danger btn-sm remove-from-cart" data-id="{{ $id }}" type="button">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                    <input type="hidden" name="products[{{ $id }}][name]" value="{{ $details['urun_adi'] }}">
                    <input type="hidden" name="products[{{ $id }}][price]" value="{{ $details['fiyat'] }}">
                    <input type="hidden" name="products[{{ $id }}][img]" value="{{ $details['img'] }}">
                @endforeach
                <div class="cart-total">
                    Toplam: <span id="cart-total">{{ number_format(array_sum(array_map(function ($item) {
                        return $item['fiyat'] * $item['quantity'];
                    }, session('cart', []))), 2) }} ₺</span>
                </div>
                <button type="submit" class="btn btn-checkout">Siparişi Tamamla</button>
            </form>
        @else
            <p class="text-center">Sepetinizde ürün bulunmamaktadır.</p>
        @endif
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('.update-quantity').click(function () {
            var id = $(this).data('id');
            var quantity = $('.quantity[data-id="' + id + '"]').val();

            if (quantity < 1) {
                alert('Miktar 1\'den küçük olamaz.');
                $('.quantity[data-id="' + id + '"]').val(1);
                return;
            }

            $.ajax({
                url: '{{ route('update.cart') }}',
                method: 'PATCH',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id,
                    quantity: quantity
                },
                success: function (response) {
                    var price = parseFloat(response.itemPrice);
                    var newQuantity = parseInt(response.quantity);

                    var cartItem = $('.cart-item[data-id="' + id + '"]');
                    cartItem.find('.cart-item-price').attr('data-price', price.toFixed(2));
                    cartItem.find('.cart-item-price').text(price.toFixed(2) + ' ₺');

                    $('#cart-total').text(response.cartTotal.toFixed(2) + ' ₺');
                },
                error: function (xhr) {
                    alert('Bir hata oluştu. Lütfen tekrar deneyin.');
                }
            });
        });

        $('.remove-from-cart').click(function () {
            var id = $(this).data('id');

            if (confirm('Bu ürünü sepetten kaldırmak istediğinize emin misiniz?')) {
                $.ajax({
                    url: '{{ route('remove.from.cart') }}',
                    method: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: id
                    },
                    success: function (response) {
                        $('.cart-item[data-id="' + id + '"]').remove();
                        $('#cart-total').text(response.cartTotal.toFixed(2) + ' ₺');

                        if (response.cartCount === 0) {
                            $('#cart-items').html('<p class="text-center">Sepetinizde ürün bulunmamaktadır.</p>');
                        }
                    },
                    error: function (xhr) {
                        alert('Bir hata oluştu. Lütfen tekrar deneyin.');
                    }
                });
            }
        });
    });

    $(document).ready(function () {
        $('.btn-checkout').click(function (e) {
            e.preventDefault(); // Formun otomatik gönderilmesini engelle
            $('form').submit(); // Formu manuel olarak gönder
        });
    });
</script>
</body>
</html>
