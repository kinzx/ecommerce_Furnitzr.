<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Furnitzr</title>
    {{-- Bootstrap 5 CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #fff;
        }

        /* Kolom Kiri (Gambar) */
        .left-side-image {
            /* Gambar interior berbeda untuk Register agar tidak bosan */
            background: url('https://images.unsplash.com/photo-1616486338812-3dadae4b4f9d?q=80&w=2070&auto=format&fit=crop') no-repeat center center;
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
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 3rem;
            color: white;
        }

        /* Form Styling */
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

            {{-- KOLOM KIRI: GAMBAR (Hidden di Mobile) --}}
            <div class="col-lg-6 d-none d-lg-block left-side-image">
                <div class="image-overlay">
                    <h2 class="fw-bold mb-2">Design your dream space</h2>
                    <p class="lead mb-4">Join thousands of homeowners finding <br> furniture they love.</p>
                    {{-- Indikator Slider (Visual Saja) --}}
                    <div class="d-flex gap-2">
                        <span
                            style="width: 8px; height: 4px; background: rgba(255,255,255,0.5); border-radius: 2px;"></span>
                        <span style="width: 25px; height: 4px; background: white; border-radius: 2px;"></span>
                        <span
                            style="width: 8px; height: 4px; background: rgba(255,255,255,0.5); border-radius: 2px;"></span>
                    </div>
                </div>
                <div class="position-absolute top-0 start-0 p-4 text-white fw-bold fs-4">
                    <i class="fa-solid fa-house me-2"></i> Furnitzr
                </div>
            </div>

            {{-- KOLOM KANAN: FORM REGISTER --}}
            <div class="col-lg-6 d-flex align-items-center justify-content-center py-5">
                <div class="w-100 px-4" style="max-width: 450px;">

                    <div class="mb-4">
                        <h2 class="fw-bold">Create Account</h2>
                        <p class="text-muted">Start your journey with us today</p>
                    </div>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        {{-- Full Name --}}
                        <div class="mb-3">
                            <label for="name" class="form-label fw-medium">Full Name</label>
                            <input type="text" name="name" class="form-control" id="name"
                                placeholder="John Doe" value="{{ old('name') }}" required autofocus>
                            @error('name')
                                <small class="text-danger mt-1 d-block">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div class="mb-3">
                            <label for="email" class="form-label fw-medium">Email Address</label>
                            <input type="email" name="email" class="form-control" id="email"
                                placeholder="example@gmail.com" value="{{ old('email') }}" required>
                            @error('email')
                                <small class="text-danger mt-1 d-block">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Password --}}
                        <div class="mb-3">
                            <label for="password" class="form-label fw-medium">Password</label>
                            <div class="input-group">
                                <input type="password" name="password" class="form-control" id="password"
                                    placeholder="Min. 8 characters"
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

                        {{-- Confirm Password --}}
                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label fw-medium">Confirm Password</label>
                            <div class="input-group">
                                <input type="password" name="password_confirmation" class="form-control"
                                    id="password_confirmation" placeholder="Re-enter password"
                                    style="border-right: 0; border-top-right-radius: 0; border-bottom-right-radius: 0;"
                                    required>
                                <span class="input-group-text bg-white border-start-0"
                                    style="border-color: #ddd; border-top-left-radius: 0; border-bottom-left-radius: 0;">
                                    <i class="fa-regular fa-eye text-muted cursor-pointer"></i>
                                </span>
                            </div>
                        </div>

                        {{-- Tombol Register --}}
                        <button type="submit" class="btn-dark-custom mb-4">Create Account</button>

                        {{-- Divider --}}
                        <div class="divider mb-4">Or sign up with</div>

                        {{-- Social Login (Google Only) --}}
                        <div class="mb-4">
                            <a href="{{ route('google.login') }}" class="btn-google w-100">
                                <img src="https://www.svgrepo.com/show/475656/google-color.svg" width="20"
                                    alt="Google">
                                Sign up with Google
                            </a>
                        </div>

                        {{-- Link ke Login --}}
                        <p class="text-center text-muted small mb-0">
                            Already have an account?
                            <a href="{{ route('login') }}" class="fw-bold text-decoration-none text-dark">Login</a>
                        </p>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
