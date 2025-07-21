@extends('layouts.guest')
@section('title', 'Đăng nhập')
@section('styles')
<style>
    .btn-outline-secondary {
        color: #fff;
        background-color: #2CA5E0;
        border-color: #2CA5E0;
    }

    .btn-outline-secondary:hover {
        color: #fff;
        background-color: #1a8bc8;
        border-color: #1a8bc8;
    }

    .btn-outline-secondary .fab.fa-telegram {
        color: #fff;
        margin-right: 8px;
    }
</style>
@endsection
@section('content')
<form action="{{route('auth.login')}}" method="POST" style="width: 100%; max-width: 400px;">
    @csrf
    @method('POST')
    <x-logo />
    <h2 class="mb-4 text-center text-uppercase">Đăng nhập</h2>
    <x-alert-general name='error-login' />
    @if(session('success'))
    <div class="alert alert-success d-flex align-items-center">
        <i class="fas fa-check-circle me-2"></i>
        <div>
            {{ session('success') }}
        </div>
    </div>
    @endif
    <div class="mb-3">
        <label for="email" class="form-label fw-bold">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" autofocus required />
        <x-error-message name="auth_failed" />
    </div>

    <div class="mb-2">
        <label for="password" class="form-label fw-bold">Mật khẩu</label>
        <input type="password" class="form-control" id="password" name="password" autocomplete="current-password" required />
        <div class=" d-flex justify-content-between align-items-center mt-1">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="showPassword" />
                <label class="form-check-label" for="showPassword">Hiện mật khẩu</label>
            </div>
            <a href="{{route('auth.forgot-password.form')}}" class="text-decoration-none small">Quên mật khẩu?</a>
        </div>
    </div>

    <div class="my-3">
        <div class="g-recaptcha" data-sitekey="{{env('RECAPTCHA_SITE_KEY')}}"></div>
        <x-error-recaptcha />
    </div>
    <button class="btn btn-primary w-100" type="submit">Đăng nhập</button>
    <div class="text-center mt-3">
        <small>Hoặc đăng nhập bằng</small>
    </div>
    <div class="d-flex justify-content-center mt-2">
        <a href="{{route('auth.login.telegram')}}" class="btn btn-outline-secondary mt-2 w-100">
            <i class="fab fa-telegram"></i> Telegram
        </a>
    </div>
    <div class="text-center mt-3">
        <small>Bạn chưa có tài khoản? <a href="{{route('auth.register.form')}}">Đăng ký</a></small>
    </div>
</form>
@endsection
@section('scripts')
<script>
    // Toggle password visibility
    $(document).ready(function() {
        $('#showPassword').change(function() {
            if ($(this).is(':checked')) {
                $('#password').attr('type', 'text');
            } else {
                $('#password').attr('type', 'password');
            }
        });
    });
</script>
<script async src="https://telegram.org/js/telegram-widget.js?22"
    data-telegram-login="{{env('TELEGRAM_BOT_USERNAME')}}"
    data-size="large"
    data-userpic="false"
    data-request-access="write"
    data-userpic="false"
    data-on-auth="onTelegramAuth">
</script>

<script>
    function onTelegramAuth(user) {
        // Gửi thông tin Telegram về server Laravel
        fetch('{{route("auth.login.telegram")}}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify(user)
        }).then(res => res.json()).then(data => {
            if (data.success) {
                window.location.href = '/dashboard';
            } else {
                alert("Login failed");
            }
        });
    }
</script>

@endsection