<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <style>
        body,
        html {
            height: 100%;
            margin: 0;
        }

        .login-container {
            display: flex;
            min-height: 100vh;
        }

        .login-left {
            background: linear-gradient(135deg, #a0c4ff, #ffc6ff, #fdffb6);
            display: flex;
            align-items: center;
            justify-content: center;
            flex: 1;
            background-image: url("{{ asset('images/login_img/banner-vnpt.webp') }}");
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
        }

        .login-right {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .btn-primary:hover {
            background-color: #0a58ca;
            border-color: #0a53be;
            transform: scale(1.010);
        }

        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
            }

            .login-left {
                height: 200px;
            }
        }
    </style>
    @yield('styles')
</head>

<body>
    <div class="login-container">
        <div class="login-left">
        </div>
        <div class="login-right">
            @yield('content')
        </div>
    </div>
</body>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@yield('scripts')

</html>