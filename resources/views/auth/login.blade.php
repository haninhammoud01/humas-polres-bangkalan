<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login - Humas Polres Bangkalan</title>
    
    {{-- Favicon --}}
    <link rel="icon" type="image/png" href="{{ asset('assets/images/Logo.png') }}">
    
    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    {{-- Font Awesome --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            height: 100vh;
            overflow: hidden;
        }
        
        /* Background dengan overlay */
        .login-container {
            position: relative;
            width: 100%;
            height: 100vh;
            background-image: url("{{ asset('assets/images/beranda.png') }}");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        /* Overlay gelap semi-transparent */
        .login-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1;
        }
        
        /* Login card */
        .login-card {
            position: relative;
            z-index: 2;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            padding: 40px 50px;
            width: 100%;
            max-width: 450px;
            animation: slideUp 0.6s ease;
        }
        
        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Logo section */
        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .login-header img {
            width: 80px;
            height: 80px;
            object-fit: contain;
            margin-bottom: 15px;
        }
        
        .login-header h4 {
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 5px;
        }
        
        .login-header p {
            color: #666;
            font-size: 14px;
            margin: 0;
        }
        
        /* Form styling */
        .form-label {
            font-weight: 500;
            color: #333;
            margin-bottom: 8px;
        }
        
        .form-control {
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            padding: 12px 15px;
            font-size: 14px;
            transition: all 0.3s;
        }
        
        .form-control:focus {
            border-color: #dc3545;
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.15);
        }
        
        .input-group-text {
            background: transparent;
            border: 2px solid #e0e0e0;
            border-right: none;
            border-radius: 10px 0 0 10px;
            color: #666;
        }
        
        .input-group .form-control {
            border-left: none;
            border-radius: 0 10px 10px 0;
        }
        
        .input-group:focus-within .input-group-text {
            border-color: #dc3545;
        }
        
        /* Remember me */
        .form-check-input:checked {
            background-color: #dc3545;
            border-color: #dc3545;
        }
        
        .form-check-label {
            font-size: 14px;
            color: #666;
        }
        
        /* Button */
        .btn-login {
            background: linear-gradient(135deg, #dc3545 0%, #b02a37 100%);
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            font-size: 16px;
            width: 100%;
            color: white;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(220, 53, 69, 0.3);
        }
        
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(220, 53, 69, 0.4);
            background: linear-gradient(135deg, #b02a37 0%, #dc3545 100%);
        }
        
        .btn-login:active {
            transform: translateY(0);
        }
        
        /* Alert */
        .alert {
            border-radius: 10px;
            border: none;
            font-size: 14px;
        }
        
        /* Footer link */
        .login-footer {
            text-align: center;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid #e0e0e0;
        }
        
        .login-footer a {
            color: #dc3545;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }
        
        .login-footer a:hover {
            color: #b02a37;
        }
        
        /* Responsive */
        @media (max-width: 576px) {
            .login-card {
                margin: 20px;
                padding: 30px 25px;
            }
            
            .login-header h4 {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            {{-- Header --}}
            <div class="login-header">
                <img src="{{ asset('assets/images/Logo.png') }}" alt="Logo Polres Bangkalan">
                <h4>Login Admin</h4>
                <p>Humas Polres Bangkalan</p>
            </div>
            
            {{-- Session Status --}}
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('status') }}
                </div>
            @endif
            
            {{-- Error Messages --}}
            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    <strong>Error!</strong> {{ $errors->first() }}
                </div>
            @endif
            
            {{-- Login Form --}}
            <form method="POST" action="{{ route('login') }}">
                @csrf
                
                {{-- Email --}}
                <div class="mb-3">
                    <label for="email" class="form-label">
                        <i class="fas fa-envelope me-1"></i> Email / Username
                    </label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-user"></i>
                        </span>
                        <input type="text" 
                               class="form-control @error('email') is-invalid @enderror" 
                               id="email" 
                               name="email" 
                               value="{{ old('email') }}" 
                               placeholder="Masukkan email atau username"
                               required 
                               autofocus>
                    </div>
                    @error('email')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>
                
                {{-- Password --}}
                <div class="mb-3">
                    <label for="password" class="form-label">
                        <i class="fas fa-lock me-1"></i> Password
                    </label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-key"></i>
                        </span>
                        <input type="password" 
                               class="form-control @error('password') is-invalid @enderror" 
                               id="password" 
                               name="password" 
                               placeholder="Masukkan password"
                               required>
                    </div>
                    @error('password')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>
                
                {{-- Remember Me --}}
                <div class="mb-4">
                    <div class="form-check">
                        <input class="form-check-input" 
                               type="checkbox" 
                               id="remember" 
                               name="remember">
                        <label class="form-check-label" for="remember">
                            Ingat saya
                        </label>
                    </div>
                </div>
                
                {{-- Submit Button --}}
                <button type="submit" class="btn btn-login">
                    <i class="fas fa-sign-in-alt me-2"></i> Masuk
                </button>
            </form>
            
            {{-- Footer --}}
            <div class="login-footer">
                <a href="{{ route('home') }}">
                    <i class="fas fa-arrow-left me-1"></i> Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
    
    {{-- Bootstrap Bundle with Popper --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
