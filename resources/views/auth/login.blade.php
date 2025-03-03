<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş Yap</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f6f9;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            margin: 0 auto;
            max-width: 450px;
            width: 100%;
            padding: 30px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .login-header {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }
        .login-header h2 {
            font-weight: bold;
        }
        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
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
    </style>
</head>
<body>

    <div class="container">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
        <div class="login-container">
            <div class="login-header">
                <h2>{{ __('Giriş Yap') }}</h2>
                <p class="text-muted">Hesabınıza erişin</p>
            </div>
            
            <form method="POST" action="{{ route('login') }}">
                @csrf
                
                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('E-Mail Adresi') }}</label>
                    <input id="email" type="email" 
                        class="form-control @error('email') is-invalid @enderror" 
                        name="email" 
                        value="{{ old('email', Cookie::get('email')) }}" 
                        required 
                        autocomplete="email" 
                        autofocus>
                    
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">{{ __('Şifre') }}</label>
                    <input id="password" type="password" 
                        class="form-control @error('password') is-invalid @enderror" 
                        name="password" 
                        value="{{ old('password', Cookie::get('password')) }}" 
                        required 
                        autocomplete="current-password">
                    
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3 d-flex justify-content-between align-items-center">
                <div class="form-check">
                    <input type="checkbox" 
                        class="form-check-input" 
                        name="remember" 
                        id="remember" 
                        {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label text-muted" for="remember">
                        {{ __('Beni Hatırla') }}
                    </label>
                </div>
                <a href="{{ route('password.request') }}" class="text-decoration-none text-primary fw-bold">
                    {{ __('Şifremi Unuttum?') }}
                </a>
                </div>


                <div class="d-flex flex-column align-items-center gap-3">
                    <button type="submit" class="btn btn-primary btn-lg w-100 rounded-pill shadow">
                        {{ __('Giriş Yap') }}
                    </button>
                    <p class="text-muted mb-0">Kaydınız yoksa</p>
                    <a href="{{ route('register') }}" class="text-primary fw-bold text-decoration-none">Buradan kayıt olabilirsiniz</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS (optional, for future interactions) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>