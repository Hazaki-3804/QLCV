@extends('layouts.guest')
@section('title', 'Quên mật khẩu')
@section('content')
<form style="width: 100%; max-width: 400px;" method="POST" action="{{ route('auth.password.email') }}">
    @csrf
    <x-logo />
    <h2 class="mb-4 text-center text-uppercase">Quên mật khẩu</h2>
    <div class="mb-3">
        <label for="email" class="form-label fw-bold">Nhập email khôi phục</label>
        <input type="email" class="form-control" id="email" name="email" required autofocus />
        <span class="text-muted small">Chúng tôi sẽ gửi liên kết đặt lại mật khẩu đến email này.</span>
    </div>
    <div class="my-3">
        <div class="g-recaptcha" data-sitekey="{{env('RECAPTCHA_SITE_KEY')}}"></div>
        <x-error-recaptcha />
    </div>
    <button class="btn btn-primary w-100" type="submit">Gửi liên kết đặt lại mật khẩu</button>

    <div class="text-center mt-3">
        <small>Bạn đã nhớ mật khẩu? <a href="{{ route('auth.login.form') }}">Đăng nhập</a></small>
    </div>
</form>
@endsection

@section('scripts')

@endsection