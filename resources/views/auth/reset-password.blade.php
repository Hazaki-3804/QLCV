@extends('layouts.guest')
@section('title', 'Đặt lại mật khẩu')
@section('content')
<form style="width: 100%; max-width: 400px;" method="POST" action="{{ route('auth.reset-password') }}">
    @csrf
    <x-logo />
    <h2 class="mb-4 text-center text-uppercase">Đặt lại mật khẩu</h2>
    
    <input type="hidden" name="token" value="{{ $token }}">
    <input type="hidden" name="email" value="{{ $email }}">
    
    <div class="mb-3">
        <label for="password" class="form-label fw-bold">Mật khẩu mới</label>
        <input type="password" class="form-control" id="password" name="password" required autofocus />
        @error('password')
            <span class="text-danger small">{{ $message }}</span>
        @enderror
    </div>
    
    <div class="mb-3">
        <label for="password_confirmation" class="form-label fw-bold">Xác nhận mật khẩu mới</label>
        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required />
        @error('password_confirmation')
            <span class="text-danger small">{{ $message }}</span>
        @enderror
    </div>
    
    <button class="btn btn-primary w-100" type="submit">Đặt lại mật khẩu</button>
    
    <div class="text-center mt-3">
        <small><a href="{{ route('auth.login.form') }}">Quay lại trang đăng nhập</a></small>
    </div>
</form>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Hiển thị thông báo lỗi nếu có
        @if($errors->any())
            const errorMessages = @json($errors->all());
            errorMessages.forEach(message => {
                console.error(message);
            });
        @endif
    });
</script>
@endsection 