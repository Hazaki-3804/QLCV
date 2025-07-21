@extends('layouts.guest')
@section('title', 'Đăng ký')
@section('styles')
<style>
    /* Styles for the password input group */
    .password-input-group {
        position: relative;
    }

    .form-label {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 0.5rem;
    }

    .caps-lock {
        color: #0d6efd;
        font-size: 0.875em;
        font-weight: 500;
        display: none;
        cursor: default;
        user-select: none;
    }

    /* Toggle password icon */
    .toggle-password {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(10%);
        cursor: pointer;
        color: #6c757d;
        font-size: 1.1em;
        z-index: 10;
    }

    /* Strength bar container */
    .strength-bar-container {
        display: flex;
        gap: 4px;
        margin-top: 8px;
        height: 6px;
        background-color: #e9ecef;
        border-radius: 3px;
        overflow: hidden;
    }

    .strength-bar-segment {
        flex-grow: 1;
        height: 100%;
        background-color: transparent;
        transition: background-color 0.3s ease;
        border-radius: 2px;
    }

    /* Strength colors */
    .strength-bar-segment.active-weak {
        background-color: #dc3545;
        /* Red - Weak */
    }

    .strength-bar-segment.active-medium {
        background-color: #ffc107;
        /* Yellow - Medium */
    }

    .strength-bar-segment.active-strong {
        background-color: #198754;
        /* Green - Strong */
    }

    .strength-bar-segment.active-very-strong {
        background-color: #0d6efd;
        /* Blue - Very strong */
    }

    .strength-text {
        font-size: 0.875em;
        color: #6c757d;
        margin-top: 5px;
    }

    #generateNewPassword {
        background-color: transparent;
        border: none;
        color: #0d6efd;
        cursor: pointer;
        font-size: 0.875em;
        margin-bottom: 10px;
    }
</style>
@endsection
@section('content')
<form style="width: 100%; max-width: 400px;" method="POST" action="{{ route('auth.register') }}">
    @csrf
    @method('POST')
    <!-- Logo VNPT -->
    <x-logo />
    <!-- Title for registration -->
    <h2 class="mb-4 text-center text-uppercase">Đăng ký</h2>
    <x-alert-general name='error-register' />

    <!-- Input fields for registration -->
    <div class="mb-2">
        <label for="name" class="form-label fw-bold">Tên người dùng</label>
        <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}" required autofocus />
        <x-error-message name="name" />
    </div>

    <div class="mb-2">
        <label for="email" class="form-label fw-bold">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}" required autocomplete="username" />
        <x-error-message name="email" />
    </div>

    <div class="mb-2">
        <div class="password-input-group">
            <label for="password" class="form-label fw-bold">
                Mật khẩu
                <span class="caps-lock" id="capsLockIndicator">ℹ️ Caps Lock is on</span>
            </label>
            <input type="password" class="form-control" id="password" name="password" autocomplete="new-password" required />
            <span class="toggle-password" data-target="#password">
                <i class="fa fa-eye"></i>
            </span>
        </div>
        <x-error-message name="password" />

        <div class="strength-bar-container" id="strengthBarContainer">
            <div class="strength-bar-segment" data-segment="1"></div>
            <div class="strength-bar-segment" data-segment="2"></div>
            <div class="strength-bar-segment" data-segment="3"></div>
            <div class="strength-bar-segment" data-segment="4"></div>
            <div class="strength-bar-segment" data-segment="5"></div>
        </div>
        <div class=" d-flex justify-content-between align-items-center mt-1">
            <p id="strengthText" class="strength-text">Độ mạnh mật khẩu</p>
            <button type="button" id="generateNewPassword">Tạo mật khẩu ngẫu nhiên</button>
        </div>
    </div>

    <div class="mb-2">
        <div class="password-input-group">
            <label for="password_confirmation" class="form-label fw-bold">Xác nhận mật khẩu</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" autocomplete="new-password" required />
            <span class="toggle-password" data-target="#password_confirmation">
                <i class="fa fa-eye"></i>
            </span>
        </div>
    </div>

    <div class="my-2">
        <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div>
        <x-error-recaptcha />
    </div>
    <button class="btn btn-primary w-100" type="submit">Đăng ký</button>

    <div class="text-center mt-2">
        <small>Bạn đã có tài khoản? <a href="{{ route('auth.login.form') }}">Đăng nhập</a></small>
    </div>
</form>
@endsection
@section('scripts')
<script>
    $(document).ready(function() {
        $('#generateNewPassword').click(function() {
            $.ajax({
                url: '{{ route("auth.register.generate-password") }}',
                method: 'GET',
                success: function(response) {
                    $('#password').val(response.password).trigger('input');
                },
                error: function(xhr) {
                    console.error('Lỗi khi tạo mật khẩu:', xhr.responseText);
                }
            });
        });
        // Chức năng ẩn/hiện mật khẩu ---
        $(".toggle-password").on('click', function() {
            $(this).find("i").toggleClass("fa-eye fa-eye-slash");
            const targetId = $(this).data('target');
            const $passwordField = $(targetId);

            if ($passwordField.attr("type") === "password") {
                $passwordField.attr("type", "text");
            } else {
                $passwordField.attr("type", "password");
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        const $passwordInput = $('#password');
        const $capsLockIndicator = $('#capsLockIndicator');
        const $strengthSegments = $('.strength-bar-segment');
        const $strengthText = $('#strengthText');

        // Kiểm tra Caps Lock
        $passwordInput.on('keydown', function(e) {
            const char = e.key;
            const isShift = e.shiftKey;
            const isCapsLockLikely = char.length === 1 && char.match(/[A-Z]/) && !isShift;
            if (isCapsLockLikely) {
                console.log('Caps Lock is on');
                $capsLockIndicator.show();
            } else {
                console.log('Caps Lock is off');
                $capsLockIndicator.hide();
            }
        });

        // Khi người dùng click ra khỏi input, ẩn cảnh báo Caps Lock
        $passwordInput.on('blur', function() {
            $capsLockIndicator.hide();
        });

        // Hàm đo độ mạnh mật khẩu
        function checkPasswordStrength(password) {
            let score = 0;
            if (password.length >= 8) score++;
            if (/[A-Z]/.test(password)) score++;
            if (/[a-z]/.test(password)) score++;
            if (/[0-9]/.test(password)) score++;
            if (/[!@#$%^&*(),.?":{}|<>]/.test(password)) score++;
            return score;
        }

        // Cập nhật thanh đo và văn bản độ mạnh ---
        $passwordInput.on('input', function() {
            const password = $(this).val();
            const strengthScore = checkPasswordStrength(password);

            let text = 'Độ mạnh mật khẩu';
            let className = '';

            $strengthSegments.removeClass('active-weak active-medium active-strong active-very-strong');

            if (password.length === 0) {
                text = 'Độ mạnh mật khẩu';
            } else if (strengthScore <= 1) {
                text = 'Yếu';
                className = 'active-weak';
            } else if (strengthScore === 2) {
                text = 'Trung bình';
                className = 'active-medium';
            } else if (strengthScore === 3) {
                text = 'Khá';
                className = 'active-medium';
            } else if (strengthScore === 4) {
                text = 'Mạnh';
                className = 'active-strong';
            } else if (strengthScore === 5) {
                text = 'Rất mạnh';
                className = 'active-very-strong';
            }

            for (let i = 0; i < strengthScore; i++) {
                $($strengthSegments[i]).addClass(className);
            }

            $strengthText.text(text);
        });

        // Kích hoạt hàm kiểm tra khi tải trang
        $passwordInput.trigger('input');
    });
</script>
@endsection
