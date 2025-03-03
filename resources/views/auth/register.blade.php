<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Kayıt Ol</title>
     <!-- Bootstrap CSS -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
     <style>
          body {
               background-color: #f4f6f9;
               display: flex;
               align-items: center;
               justify-content: center;
               min-height: 100vh; /* Sayfa yüksekliği kadar genişlet */
               margin: 0;
               padding: 20px; /* Kenar boşlukları ekle */
          }

          .register-container {
               margin: 0 auto;
               max-width: 450px;
               width: 100%;
               padding: 20px; /* İç boşlukları azalt */
               background-color: white;
               border-radius: 10px;
               box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
          }

          .register-header {
               text-align: center;
               margin-bottom: 20px; /* Başlık altı boşluğunu azalt */
               color: #333;
          }

          .register-header h2 {
               font-weight: bold;
               margin-bottom: 5px; /* Başlık altı boşluğunu azalt */
          }

          .register-header p {
               margin-bottom: 0; /* Alt başlık altı boşluğunu kaldır */
          }

          .form-control:focus {
               border-color: #007bff;
               box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, .25);
          }

          .btn-primary {
               background-color: #007bff;
               border-color: #007bff;
               transition: all 0.3s ease;
          }

          .btn-primary:hover {
               background-color: #0056b3;
               border-color: #0056b3;
          }

          .form-check-input:checked {
               background-color: #007bff;
               border-color: #007bff;
          }

          .mb-3 {
               margin-bottom: 1rem !important; /* Form elemanları arası boşluğu sabitle */
          }

          .d-grid {
               margin-top: 1rem; /* Buton üstü boşluğu ekle */
          }

          .mt-3 {
               margin-top: 1rem !important; /* Giriş yap linki üstü boşluğu ekle */
          }
     </style>
</head>

<body>
     <div class="container">
          <div class="register-container">
               <div class="register-header">
                    <h2>{{ __('Kayıt Ol') }}</h2>
                    <p class="text-muted">Yeni bir hesap oluşturun</p>
               </div>

               <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- İsim Alanı -->
                    <div class="mb-3">
                         <label for="name" class="form-label">{{ __('İsim') }}</label>
                         <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                              name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                         @error('name')
                         <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                         </span>
                         @enderror
                    </div>

                    <!-- E-Posta Alanı -->
                    <div class="mb-3">
                         <label for="email" class="form-label">{{ __('E-Mail Adresi') }}</label>
                         <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                              name="email" value="{{ old('email') }}" required autocomplete="email">

                         @error('email')
                         <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                         </span>
                         @enderror
                    </div>

                    <!-- Şifre Alanı -->
                    <div class="mb-3">
                         <label for="password" class="form-label">{{ __('Şifre') }}</label>
                         <input id="password" type="password"
                              class="form-control @error('password') is-invalid @enderror" name="password" required
                              autocomplete="new-password">

                         @error('password')
                         <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                         </span>
                         @enderror
                    </div>

                    <!-- Şifre Tekrar Alanı -->
                    <div class="mb-3">
                         <label for="password-confirm" class="form-label">{{ __('Şifreyi Onayla') }}</label>
                         <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                              required autocomplete="new-password">
                    </div>

                    <!-- Kayıt Ol Butonu -->
                    <div class="d-grid">
                         <button type="submit" class="btn btn-primary btn-lg">
                              {{ __('Kayıt Ol') }}
                         </button>
                    </div>

                    <!-- Giriş Yap Sayfasına Link -->
                    <div class="mt-3 text-center">
                         <p class="text-muted">Zaten bir hesabınız var mı?
                              <a href="{{ route('login') }}" style="text-decoration: none;" class="text-primary">Giriş Yap</a>
                         </p>
                    </div>
               </form>
          </div>
     </div>

     <!-- Bootstrap JS (optional, for future interactions) -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>