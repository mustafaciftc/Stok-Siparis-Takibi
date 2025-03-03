<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Şifre Sıfırlama</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card {
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
        }

        .card-header {
            background-color: #2575fc;
            color: white;
            font-weight: bold;
            text-align: center;
            font-size: 1.25rem;
        }

        .btn-primary {
            background-color: #2575fc;
            border: none;
            transition: 0.3s ease-in-out;
        }

        .btn-primary:hover {
            background-color: #1a5ed9;
        }

        .form-control {
            border-radius: 8px;
        }

        .invalid-feedback {
            font-size: 0.875rem;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card p-4">
                    <div class="card-header">
                        Şifre Sıfırlama
                    </div>
                    <div class="card-body">
                        <p class="text-center text-muted">Lütfen kayıtlı e-posta adresinizi girin, size şifre sıfırlama bağlantısı gönderelim.</p>

                        <!-- Başarı mesajı -->
                        <div id="statusMessage" class="alert alert-success d-none" role="alert">
                            Şifre sıfırlama bağlantısı e-posta adresinize gönderildi.
                        </div>

                        <form id="resetForm">
                            <div class="mb-3">
                                <label for="email" class="form-label">E-Posta Adresiniz</label>
                                <input type="email" class="form-control" id="email" required placeholder="example@mail.com">
                                <div class="invalid-feedback">Lütfen geçerli bir e-posta adresi girin.</div>
                            </div>

                            <div class="d-grid mt-3">
                                <button type="submit" class="btn btn-primary">Şifre Sıfırlama Bağlantısı Gönder</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('resetForm').addEventListener('submit', function (e) {
            e.preventDefault();
            let emailInput = document.getElementById('email');
            
            if (!emailInput.value.includes('@')) {
                emailInput.classList.add('is-invalid');
            } else {
                emailInput.classList.remove('is-invalid');
                document.getElementById('statusMessage').classList.remove('d-none');
            }
        });
    </script>

</body>

</html>
