<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Models\TaiKhoan;
use Illuminate\Support\Facades\Hash;


class ForgotPasswordController extends Controller
{
    use VerifyRecaptcha;

    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email'],
            'g-recaptcha-response' => ['required'],
        ], [
            'email.required' => 'Email là bắt buộc.',
            'email.email' => 'Email không hợp lệ.',
            'g-recaptcha-response.required' => 'Vui lòng xác minh reCAPTCHA.',
        ]);

        // Verify reCAPTCHA
        if (!$this->verifyRecaptcha($request)) {
            return back()->withErrors(['captcha' => 'Xác minh reCAPTCHA không thành công.']);
        }

        // Kiểm tra email có tồn tại trong hệ thống không
        $user = TaiKhoan::where('email', $request->email)->first();
        if (!$user) {
            return back()->withErrors(['email' => 'Không tìm thấy tài khoản với email này.']);
        }

        // Tạo token reset mật khẩu
        $token = Str::random(64);

        // Lưu token vào database
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            [
                'email' => $request->email,
                'token' => Hash::make($token),
                'created_at' => Carbon::now()
            ]
        );

        // Tạo URL reset password
        $resetUrl = url(route('auth.reset-password.form', [
            'token' => $token,
            'email' => $request->email,
        ], false));

        // Gửi email với link reset password
        $this->sendResetLinkEmail($request->email, $resetUrl, $user->ten_nguoi_dung ?? 'Người dùng');

        return back()->with('status', 'Liên kết đặt lại mật khẩu đã được gửi đến email của bạn.');
    }

    /**
     * Gửi email chứa link reset mật khẩu
     */
    protected function sendResetLinkEmail($email, $resetUrl, $userName)
    {
        $data = [
            'resetUrl' => $resetUrl,
            'userName' => $userName
        ];

        Mail::send('emails.reset-password', $data, function ($message) use ($email) {
            $message->to($email)
                ->subject('Đặt lại mật khẩu');
        });
    }

    /**
     * Hiển thị form đặt lại mật khẩu
     */
    public function showResetPasswordForm(Request $request)
    {
        return view('auth.reset-password', [
            'token' => $request->token,
            'email' => $request->email
        ]);
    }

    /**
     * Xử lý đặt lại mật khẩu
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ], [
            'password.required' => 'Mật khẩu là bắt buộc.',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp.',
        ]);

        // Kiểm tra token có hợp lệ không
        $tokenData = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->first();

        if (!$tokenData || !Hash::check($request->token, $tokenData->token)) {
            return back()->withErrors(['email' => 'Liên kết đặt lại mật khẩu không hợp lệ hoặc đã hết hạn.']);
        }

        // Kiểm tra thời gian tạo token (60 phút)
        if (Carbon::parse($tokenData->created_at)->addMinutes(60)->isPast()) {
            DB::table('password_reset_tokens')->where('email', $request->email)->delete();
            return back()->withErrors(['email' => 'Liên kết đặt lại mật khẩu đã hết hạn.']);
        }

        // Cập nhật mật khẩu
        $user = TaiKhoan::where('email', $request->email)->first();
        if (!$user) {
            return back()->withErrors(['email' => 'Không tìm thấy tài khoản với email này.']);
        }

        $user->mat_khau = Hash::make($request->password);
        $user->save();

        // Xóa token đã sử dụng
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return redirect()->route('auth.login.form')
            ->with('success', 'Mật khẩu của bạn đã được đặt lại thành công. Bạn có thể đăng nhập ngay bây giờ.');
    }
}
