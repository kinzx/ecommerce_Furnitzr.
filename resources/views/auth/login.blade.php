<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Furnitzr</title>
    {{-- Bootstrap 5 CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Google Fonts (Poppins) --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    {{-- Font Awesome untuk Ikon --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #fff;
        }

        /* Kolom Kiri (Gambar) */
        .left-side-image {
            /* Ganti URL ini dengan gambar pilihan Anda */
            background: url('https://images.unsplash.com/photo-1600585154340-be6161a56a0c?q=80&w=2070&auto=format&fit=crop') no-repeat center center;
            background-size: cover;
            position: relative;
        }

        .image-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4);
            /* Overlay gelap transparan */
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 3rem;
            color: white;
        }

        /* Kolom Kanan (Form) */
        .form-control {
            background-color: #fff;
            border: 1px solid #ddd;
            padding: 12px 15px;
            height: 50px;
            border-radius: 8px;
        }

        .form-control:focus {
            border-color: #212529;
            box-shadow: none;
        }

        .btn-dark-custom {
            background-color: #212529;
            color: white;
            border: none;
            padding: 12px;
            font-weight: 600;
            width: 100%;
            border-radius: 8px;
            transition: 0.3s;
        }

        .btn-dark-custom:hover {
            background-color: #000;
        }

        .btn-google {
            border: 1px solid #ddd;
            color: #333;
            font-weight: 500;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 10px;
            border-radius: 8px;
            text-decoration: none;
            transition: 0.3s;
            background: #fff;
        }

        .btn-google:hover {
            background-color: #f8f9fa;
            border-color: #ccc;
        }

        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            color: #999;
            font-size: 0.9rem;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #ddd;
        }

        .divider::before {
            margin-right: .5em;
        }

        .divider::after {
            margin-left: .5em;
        }
    </style>
</head>

<body>

    <div class="container-fluid min-vh-100 p-0">
        <div class="row g-0 min-vh-100">

            {{-- KOLOM KIRI: GAMBAR Latar Belakang (Hidden di Mobile) --}}
            <div class="col-lg-6 d-none d-lg-block left-side-image">
                <div class="image-overlay">
                    <h2 class="fw-bold mb-2">Find your sweet home</h2>
                    <p class="lead mb-4">Schedule visit in just a few clicks.<br>Visits in just a few clicks.</p>
                    {{-- Indikator Slider (Opsional, Visual Saja) --}}
                    <div class="d-flex gap-2">
                        <span style="width: 25px; height: 4px; background: white; border-radius: 2px;"></span>
                        <span
                            style="width: 8px; height: 4px; background: rgba(255,255,255,0.5); border-radius: 2px;"></span>
                        <span
                            style="width: 8px; height: 4px; background: rgba(255,255,255,0.5); border-radius: 2px;"></span>
                    </div>
                </div>
                {{-- Logo di Pojok Kiri Atas Gambar --}}
                <div class="position-absolute top-0 start-0 p-4 text-white fw-bold fs-4">
                    <i class="fa-solid fa-house me-2"></i> Furnitzr
                </div>
            </div>

            {{-- KOLOM KANAN: FORM LOGIN --}}
            <div class="col-lg-6 d-flex align-items-center justify-content-center py-5">
                <div class="w-100 px-4" style="max-width: 450px;">

                    <div class="mb-5">
                        <h2 class="fw-bold">Welcome Back!</h2>
                        <p class="text-muted">Sign in to your account</p>
                    </div>

                    {{-- Form Login --}}
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        {{-- Email --}}
                        <div class="mb-3">
                            <label for="email" class="form-label fw-medium">Your Email</label>
                            <input type="email" name="email" class="form-control" id="email"
                                placeholder="example@gmail.com" value="{{ old('email') }}" required autofocus>
                            @error('email')
                                <small class="text-danger mt-1 d-block">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Password --}}
                        <div class="mb-3">
                            <label for="password" class="form-label fw-medium">Password</label>
                            <div class="input-group">
                                <input type="password" name="password" class="form-control" id="password"
                                    placeholder="••••••••"
                                    style="border-right: 0; border-top-right-radius: 0; border-bottom-right-radius: 0;"
                                    required>
                                <span class="input-group-text bg-white border-start-0"
                                    style="border-color: #ddd; border-top-left-radius: 0; border-bottom-left-radius: 0;">
                                    <i class="fa-regular fa-eye text-muted cursor-pointer"></i>
                                </span>
                            </div>
                            @error('password')
                                <small class="text-danger mt-1 d-block">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Remember Me & Forgot Password --}}
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember_me">
                                <label class="form-check-label small text-muted" for="remember_me">Remember Me</label>
                            </div>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}"
                                    class="small text-decoration-none text-muted fw-medium">Forgot Password?</a>
                            @endif
                        </div>

                        {{-- Tombol Login Utama --}}
                        <button type="submit" class="btn-dark-custom mb-4">Login</button>

                        {{-- Divider --}}
                        <div class="divider mb-4">Instant Login</div>

                        {{-- Social Login (Hanya Google) --}}
                        <div class="mb-4">
                            <a href="{{ route('google.login') }}" class="btn-google w-100">
                                <img src="https://www.svgrepo.com/show/475656/google-color.svg" width="20"
                                    alt="Google">
                                Continue with Google
                            </a>
                        </div>

                        {{-- Link ke Register --}}
                        <p class="text-center text-muted small mb-0">
                            Don't have any account?
                            <a href="{{ route('register') }}"
                                class="fw-bold text-decoration-none text-dark">Register</a>
                        </p>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
