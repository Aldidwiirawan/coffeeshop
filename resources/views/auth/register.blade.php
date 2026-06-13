<!doctype html>
<html lang="id">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        * { font-family: 'Poppins', sans-serif; }
        body {
            background: linear-gradient(135deg, #f3e5ab, #d7a86e);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            overflow: hidden;
        }
        .background-logo {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            opacity: 0.1;
            z-index: -2;
            width: 50%;
            max-width: 500px;
        }
        .background-effect {
            position: absolute;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #f3e5ab, #d7a86e);
            animation: backgroundAnimation 10s infinite alternate;
            z-index: -1;
        }
        @keyframes backgroundAnimation {
            0% { background: linear-gradient(135deg, #f3e5ab, #d7a86e); }
            50% { background: linear-gradient(135deg, #ffcc80, #e69b66); }
            100% { background: linear-gradient(135deg, #f3e5ab, #d7a86e); }
        }
        .login-card {
            max-width: 420px;
            background: rgba(255, 255, 255, 0.4);
            backdrop-filter: blur(15px);
            border-radius: 16px;
            padding: 3rem;
            text-align: center;
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: #4a2c2a;
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .login-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
        }
        .login-card h4 {
            font-weight: bold;
            margin-bottom: 15px;
            color: #4a2c2a;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .form-control {
            border-radius: 12px;
            border: none;
            background: rgba(255, 255, 255, 0.7);
            color: #4a2c2a;
            padding: 14px;
            transition: background 0.3s ease, box-shadow 0.3s ease;
        }
        .form-control:focus {
            background: rgba(255, 255, 255, 0.85);
            box-shadow: 0 0 12px rgba(255, 255, 255, 0.6);
            border-color: transparent;
        }
        .btn-coffee {
            background: linear-gradient(135deg, #ff9800, #d84315);
            border: none;
            border-radius: 12px;
            padding: 14px;
            font-weight: bold;
            color: #fff;
            transition: all 0.3s ease;
            text-transform: uppercase;
        }
        .btn-coffee:hover {
            background: linear-gradient(135deg, #d84315, #ff9800);
            transform: scale(1.08);
            box-shadow: 0 6px 18px rgba(255, 152, 0, 0.6);
        }
        .input-group-text {
            background: transparent;
            border-right: none;
            color: #4a2c2a;
        }
    </style>
  </head>
  <body>
    <div class="background-effect"></div>
    <div class="login-card">
        <h4><i class="fa fa-mug-hot"></i> DWIJAYA COFFEE</h4>
        <p class="text-dark">Nikmati secangkir kopi & daftar akun Anda</p>
        <img src="{{ asset('storage/logo dwijaya.jpg') }}" alt="Dwijaya Coffee Shop Logo" class="background-logo">
        <form action="{{ route('register') }}" method="POST">
            @csrf

            <div class="mb-3 input-group">
                <span class="input-group-text"><i class="fa fa-user"></i></span>
                <input type="text" name="name" class="form-control" placeholder="Masukkan nama lengkap" required>
            </div>

            <div class="mb-3 input-group">
                <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                <input type="email" name="email" class="form-control" placeholder="Masukkan email anda" required>
            </div>

            <div class="mb-3 input-group">
                <span class="input-group-text"><i class="fa fa-lock"></i></span>
                <input type="password" name="password" class="form-control" placeholder="Masukkan password anda" required>
            </div>

            <div class="mb-3 input-group">
                <span class="input-group-text"><i class="fa fa-lock"></i></span>
                <input type="password" name="password_confirmation" class="form-control" placeholder="Konfirmasi password anda" required>
            </div>

            <button type="submit" class="btn btn-coffee w-100">Daftar</button>
        </form>

        <div class="mt-2">
            Sudah punya akun? <a href="{{ route('login') }}">Masuk Sekarang</a>
        </div>
    </div>
  </body>
</html>
