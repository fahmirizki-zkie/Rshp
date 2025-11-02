<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - {{ config('app.name', 'Laravel') }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 50%, #7e22ce 100%);
            position: relative;
            overflow: hidden;
        }

        /* Animated Background */
        body::before {
            content: '';
            position: absolute;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 1px, transparent 1px);
            background-size: 50px 50px;
            animation: moveBackground 20s linear infinite;
        }

        @keyframes moveBackground {
            0% { transform: translate(0, 0); }
            100% { transform: translate(50px, 50px); }
        }

        /* Floating shapes for depth */
        .floating-shape {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            animation: float 15s ease-in-out infinite;
        }

        .shape1 {
            width: 300px;
            height: 300px;
            top: 10%;
            left: 10%;
            animation-delay: 0s;
        }

        .shape2 {
            width: 200px;
            height: 200px;
            bottom: 15%;
            right: 10%;
            animation-delay: 3s;
        }

        .shape3 {
            width: 150px;
            height: 150px;
            top: 50%;
            right: 20%;
            animation-delay: 6s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            33% { transform: translateY(-30px) rotate(120deg); }
            66% { transform: translateY(30px) rotate(240deg); }
        }

        .login-container {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 480px;
            padding: 20px;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(30px) saturate(180%);
            -webkit-backdrop-filter: blur(30px) saturate(180%);
            border-radius: 30px;
            padding: 50px 45px;
            box-shadow: 
                0 8px 32px 0 rgba(31, 38, 135, 0.37),
                inset 0 1px 0 0 rgba(255, 255, 255, 0.2),
                inset 0 -1px 0 0 rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.18);
            position: relative;
            overflow: hidden;
        }

        .login-card::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(
                45deg,
                transparent,
                rgba(255, 255, 255, 0.05),
                transparent
            );
            transform: rotate(45deg);
            pointer-events: none;
        }

        .login-header {
            text-align: center;
            margin-bottom: 40px;
            position: relative;
        }

        .login-header h1 {
            color: #ffffff;
            font-size: 36px;
            font-weight: 700;
            margin-bottom: 10px;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
            letter-spacing: -0.5px;
        }

        .login-header p {
            color: rgba(255, 255, 255, 0.8);
            font-size: 15px;
            font-weight: 400;
        }

        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        .form-group label {
            display: block;
            color: rgba(255, 255, 255, 0.9);
            font-weight: 500;
            margin-bottom: 10px;
            font-size: 14px;
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
        }

        .form-control-glass {
            width: 100%;
            padding: 16px 20px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1.5px solid rgba(255, 255, 255, 0.2);
            border-radius: 15px;
            font-size: 15px;
            color: #ffffff;
            transition: all 0.3s ease;
            box-shadow: 
                inset 0 2px 4px rgba(0, 0, 0, 0.1),
                0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .form-control-glass::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        .form-control-glass:focus {
            outline: none;
            background: rgba(255, 255, 255, 0.15);
            border-color: rgba(255, 255, 255, 0.4);
            box-shadow: 
                inset 0 2px 4px rgba(0, 0, 0, 0.1),
                0 4px 20px rgba(255, 255, 255, 0.1),
                0 0 0 3px rgba(255, 255, 255, 0.05);
            transform: translateY(-2px);
        }

        .form-control-glass.is-invalid {
            border-color: rgba(255, 100, 100, 0.6);
            background: rgba(255, 100, 100, 0.1);
        }

        .invalid-feedback {
            color: #ffb3b3;
            font-size: 13px;
            margin-top: 8px;
            display: block;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
            font-weight: 500;
        }

        .alert-glass {
            padding: 16px 20px;
            border-radius: 15px;
            margin-bottom: 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 14px;
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            animation: slideDown 0.3s ease;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert-success {
            background: rgba(34, 197, 94, 0.2);
            color: #bbf7d0;
            border: 1px solid rgba(34, 197, 94, 0.3);
        }

        .alert-danger {
            background: rgba(239, 68, 68, 0.2);
            color: #fecaca;
            border: 1px solid rgba(239, 68, 68, 0.3);
        }

        .btn-close {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            font-size: 18px;
            cursor: pointer;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
        }

        .btn-close:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: rotate(90deg);
        }

        .remember-me {
            display: flex;
            align-items: center;
            margin-bottom: 30px;
        }

        .remember-me input[type="checkbox"] {
            width: 20px;
            height: 20px;
            margin-right: 10px;
            cursor: pointer;
            accent-color: #a855f7;
        }

        .remember-me label {
            color: rgba(255, 255, 255, 0.85);
            font-size: 14px;
            cursor: pointer;
            margin: 0;
            user-select: none;
        }

        .btn-login {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, #a855f7 0%, #ec4899 100%);
            color: white;
            border: none;
            border-radius: 15px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 
                0 4px 15px rgba(168, 85, 247, 0.4),
                inset 0 1px 0 rgba(255, 255, 255, 0.2);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            position: relative;
            overflow: hidden;
        }

        .btn-login::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .btn-login:hover {
            transform: translateY(-3px);
            box-shadow: 
                0 8px 25px rgba(168, 85, 247, 0.6),
                inset 0 1px 0 rgba(255, 255, 255, 0.3);
        }

        .btn-login:hover::before {
            left: 100%;
        }

        .btn-login:active {
            transform: translateY(-1px);
        }

        .btn-back {
         width: 100%;
        padding: 16px;
        background: linear-gradient(135deg, #a855f7 0%, #ec4899 100%);
        color: white;
        border: none;
        border-radius: 15px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 
            0 4px 15px rgba(168, 85, 247, 0.4),
            inset 0 1px 0 rgba(255, 255, 255, 0.2);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        position: relative;
        overflow: hidden;
        text-decoration: none;
        text-align: center;
        display: inline-block;
        margin-top: 15px;
        }

         .btn-back::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .btn-back:hover {
            transform: translateY(-3px);
            box-shadow: 
                0 8px 25px rgba(168, 85, 247, 0.6),
                inset 0 1px 0 rgba(255, 255, 255, 0.3);
        }

        .btn-back:hover::before {
            left: 100%;
        }

        .btn-back:active {
            transform: translateY(-1px);
        }

        .forgot-password {
            text-align: center;
            margin-top: 25px;
        }

        .forgot-password a {
            color: rgba(255, 255, 255, 0.85);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s ease;
            padding: 8px 16px;
            border-radius: 10px;
            display: inline-block;
        }

        .forgot-password a:hover {
            color: #ffffff;
            background: rgba(255, 255, 255, 0.1);
            text-shadow: 0 2px 10px rgba(255, 255, 255, 0.3);
        }

        @media (max-width: 576px) {
            .login-card {
                padding: 40px 30px;
            }

            .login-header h1 {
                font-size: 28px;
            }
        }
    </style>
</head>
<body>
    <div class="floating-shape shape1"></div>
    <div class="floating-shape shape2"></div>
    <div class="floating-shape shape3"></div>

    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <h1>Welcome</h1>
                <p>Please login to your account</p>
            </div>

            @if(session('success'))
                <div class="alert-glass alert-success" role="alert">
                    <span>{{ session('success') }}</span>
                    <button type="button" class="btn-close" onclick="this.parentElement.remove()">×</button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert-glass alert-danger" role="alert">
                    <span>{{ session('error') }}</span>
                    <button type="button" class="btn-close" onclick="this.parentElement.remove()">×</button>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label for="email">{{ __('Email Address') }}</label>
                    <input id="email" 
                           type="email" 
                           class="form-control-glass @error('email') is-invalid @enderror" 
                           name="email" 
                           value="{{ old('email') }}" 
                           required 
                           autocomplete="email" 
                           autofocus
                           placeholder="Enter your email">
                    
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">{{ __('Password') }}</label>
                    <input id="password" 
                           type="password" 
                           class="form-control-glass @error('password') is-invalid @enderror" 
                           name="password" 
                           required 
                           autocomplete="current-password"
                           placeholder="Enter your password">
                    
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="remember-me">
                    <input type="checkbox" 
                           name="remember" 
                           id="remember" 
                           {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember">{{ __('Remember Me') }}</label>
                </div>

                <button type="submit" class="btn-login">
                    {{ __('Login') }}
                </button>

                <a href="{{ route('home') }}" class="btn-back">
                    {{ __('Back') }}
                </a>

                @if (Route::has('password.request'))
                    <div class="forgot-password">
                        <a href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    </div>
                @endif
            </form>
        </div>
    </div>
</body>
</html>