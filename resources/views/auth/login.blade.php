<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Masuk - Kost Asri</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500;9..144,600;9..144,700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --hijau-tua: #1c3a2e;
            --hijau: #2d5443;
            --krem: #f0e6d2;
            --krem-lembut: #f7f2e7;
            --emas: #8a6d3b;
            --putih: #ffffff;
            --abu-muda: #e5e7eb;
            --merah: #dc2626;
            --hijau-sukses: #16a34a;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: 'Inter', system-ui, sans-serif;
            background-color: var(--krem-lembut);
            color: var(--hijau-tua);
        }

        .font-display { font-family: 'Fraunces', Georgia, serif; }

        .login-wrap {
            min-height: 100vh;
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 48px 24px;
            overflow: hidden;
        }

        .login-wrap .aksen {
            position: absolute;
            pointer-events: none;
            width: 320px;
            height: 320px;
            opacity: 0.05;
        }
        .login-wrap .aksen-1 { top: -100px; left: -100px; transform: rotate(12deg); }
        .login-wrap .aksen-2 { bottom: -140px; right: -140px; transform: rotate(-6deg); opacity: 0.045; }

        .login-box {
            width: 100%;
            max-width: 380px;
            position: relative;
            z-index: 1;
        }

        .alert-success {
            background: rgba(22, 163, 74, 0.08);
            border: 1px solid rgba(22, 163, 74, 0.2);
            color: var(--hijau-sukses);
            padding: 12px 16px;
            border-radius: 8px;
            font-size: 0.85rem;
            margin-bottom: 20px;
            text-align: center;
        }

        .login-header {
            text-align: center;
            margin-bottom: 32px;
        }

        .login-logo {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 56px;
            height: 56px;
            border-radius: 999px;
            background: var(--hijau-tua);
            margin-bottom: 16px;
            box-shadow: 0 6px 16px rgba(28, 58, 46, 0.25);
        }

        .login-header h1 {
            font-family: 'Fraunces', serif;
            font-weight: 600;
            font-size: 1.85rem;
            margin: 0 0 6px;
            color: var(--hijau-tua);
        }

        .login-header p {
            color: var(--emas);
            font-size: 0.88rem;
            margin: 0;
        }

        .login-card {
            background: var(--putih);
            border-radius: 16px;
            box-shadow: 0 12px 32px rgba(28, 58, 46, 0.10);
            border: 1px solid var(--abu-muda);
            padding: 32px 28px;
        }

        .form-group { margin-bottom: 18px; }

        .form-label {
            display: block;
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--hijau-tua);
            margin-bottom: 6px;
        }

        .form-control {
            display: block;
            width: 100%;
            padding: 11px 14px;
            font-size: 0.9rem;
            font-family: 'Inter', sans-serif;
            color: var(--hijau-tua);
            background-color: var(--krem-lembut);
            border: 1px solid var(--abu-muda);
            border-radius: 8px;
            transition: border-color 0.15s ease, box-shadow 0.15s ease, background-color 0.15s ease;
        }

        .form-control::placeholder { color: rgba(28, 58, 46, 0.35); }

        .form-control:focus {
            outline: none;
            border-color: var(--hijau);
            box-shadow: 0 0 0 3px rgba(45, 84, 67, 0.15);
            background-color: var(--putih);
        }

        .form-error {
            margin-top: 6px;
            font-size: 0.78rem;
            color: var(--merah);
        }

        .login-options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin: 6px 0 22px;
        }

        .form-check {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 0.85rem;
            cursor: pointer;
            user-select: none;
        }

        .form-check input[type="checkbox"] {
            width: 16px;
            height: 16px;
            accent-color: var(--hijau);
        }

        .login-options a {
            font-size: 0.8rem;
            font-weight: 500;
            color: var(--emas);
            text-decoration: none;
            transition: color 0.15s ease;
        }
        .login-options a:hover { color: var(--hijau-tua); }

        .btn-primary {
            display: block;
            width: 100%;
            padding: 12px 22px;
            border-radius: 8px;
            font-size: 0.92rem;
            font-weight: 600;
            font-family: 'Inter', sans-serif;
            border: none;
            cursor: pointer;
            background-color: var(--hijau-tua);
            color: var(--krem);
            transition: background-color 0.15s ease, transform 0.1s ease;
        }
        .btn-primary:hover { background-color: var(--hijau); }
        .btn-primary:active { transform: translateY(1px); }

        .login-footer {
            text-align: center;
            font-size: 0.75rem;
            color: rgba(28, 58, 46, 0.4);
            margin-top: 28px;
        }
    </style>
</head>
<body>

    <div class="login-wrap">

        <div class="aksen aksen-1">
            <svg viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%">
                <path d="M50 5 L95 50 L50 95 L5 50 Z" stroke="#1c3a2e" stroke-width="4"/>
            </svg>
        </div>
        <div class="aksen aksen-2">
            <svg viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%">
                <path d="M50 5 L95 50 L50 95 L5 50 Z" stroke="#8a6d3b" stroke-width="4"/>
            </svg>
        </div>

        <div class="login-box">

            @if (session('status'))
                <div class="alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <div class="login-header">
                <div class="login-logo">
                    <svg width="26" height="26" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M3 11.5L12 4L21 11.5" stroke="#f0e6d2" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M5.5 10V19.5C5.5 19.7761 5.72386 20 6 20H18C18.2761 20 18.5 19.7761 18.5 19.5V10" stroke="#f0e6d2" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M10 20V14.5C10 14.2239 10.2239 14 10.5 14H13.5C13.7761 14 14 14.2239 14 14.5V20" stroke="#f0e6d2" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <h1>Kost Asri</h1>
                <p>Masuk untuk mengelola kost Anda</p>
            </div>

            <div class="login-card">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                            class="form-control" placeholder="nama@email.com">
                        @error('email')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">Kata sandi</label>
                        <input id="password" type="password" name="password" required autocomplete="current-password"
                            class="form-control" placeholder="••••••••">
                        @error('password')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="login-options">
                        <label for="remember_me" class="form-check">
                            <input id="remember_me" type="checkbox" name="remember">
                            <span>Ingat saya</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}">Lupa kata sandi?</a>
                        @endif
                    </div>

                    <button type="submit" class="btn-primary">
                        Masuk
                    </button>
                </form>
            </div>

            <p class="login-footer">
                &copy; {{ date('Y') }} Kost Asri. Nyaman seperti rumah sendiri.
            </p>
        </div>
    </div>
</body>
</html>