<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\TaiKhoan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

class RegisterController extends Controller
{
    use VerifyRecaptcha;
    /**
     * Show the application's registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegisterForm()
    {
        return view('auth.register');
    }
    /**
     * Handle a registration request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register1(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $data = $request->validate(
            [
                'name' => ['required', 'string', 'max:255', 'regex:/^[\p{L} ]+$/u'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:tai_khoan,email'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'g-recaptcha-response' => ['required'],
                'password_confirmation' => ['required', 'string', 'min:8']
            ],
            [
                'name.required' => 'Tên là bắt buộc.',
                'name.regex' => 'Tên chỉ được chứa chữ cái và khoảng trắng.',
                'email.required' => 'Email là bắt buộc.',
                'email.email' => 'Email không hợp lệ.',
                'email.unique' => 'Email này đã được sử dụng để đăng ký. Vui lòng sử dụng email khác.',
                'password.required' => 'Mật khẩu là bắt buộc.',
                'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
                'password.confirmed' => 'Mật khẩu xác nhận không khớp.',
                'g-recaptcha-response.required' => 'Vui lòng xác minh reCAPTCHA.',
            ]
        );
        if ($data['password'] !== $data['password_confirmation']) {
            return back()->withErrors(['password' => 'Mật khẩu xác nhận không khớp.'])->withInput();
        }
        // Kiểm tra reCAPTCHA với Google
        if (!$this->verifyRecaptcha($request)) {
            return back()->withErrors(['captcha' => 'Xác minh reCAPTCHA không thành công.'])->withInput();
        }
        // Tạo người dùng mới
        TaiKhoan::create([
            'ten_nguoi_dung' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'loai_taikhoan_id' => 5, // 5 là ID của loại tài khoản người dùng bình thường
            'trang_thai' => 1, // 1 là trạng thái hoạt động
        ]);
        // Chuyển hướng người dùng đến trang đăng nhập và yêu cầu họ đăng nhập
        return redirect()->route('login')->with('success', 'Đăng ký thành công! Vui lòng đăng nhập.');
    }
    public function register(Request $request)
    {
        try {
            // Xác thực dữ liệu đầu vào
            $data = $request->validate(
                [
                    'name' => ['required', 'string', 'max:255', 'regex:/^[\p{L} ]+$/u'],
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:tai_khoan,email'],
                    'password' => ['required', 'string', 'min:8', 'confirmed'],
                    'g-recaptcha-response' => ['required'],
                    'password_confirmation' => ['required', 'string', 'min:8']
                ],
                [
                    'name.required' => 'Tên là bắt buộc.',
                    'name.regex' => 'Tên chỉ được chứa chữ cái và khoảng trắng.',
                    'email.required' => 'Email là bắt buộc.',
                    'email.email' => 'Email không hợp lệ.',
                    'email.unique' => 'Email này đã được sử dụng để đăng ký. Vui lòng sử dụng email khác.',
                    'password.required' => 'Mật khẩu là bắt buộc.',
                    'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
                    'password.confirmed' => 'Mật khẩu xác nhận không khớp.',
                    'g-recaptcha-response.required' => 'Vui lòng xác minh reCAPTCHA.',
                ]
            );
            // Kiểm tra độ mạnh của mật khẩu
            $strength = $this->checkStrengthPassword($data['password']);
            if ($strength === 1) {
                return back()->withErrors(['password' => 'Mật khẩu quá yếu. Vui lòng sử dụng mật khẩu mạnh hơn.'])->withInput();
            }
            // Kiểm tra reCAPTCHA với Google
            if (!$this->verifyRecaptcha($request)) {
                return back()->withErrors(['captcha' => 'Xác minh reCAPTCHA không thành công.'])->withInput();
            }

            // Tạo người dùng mới
            TaiKhoan::create([
                'ten_nguoi_dung' => $data['name'],
                'email' => $data['email'],
                'mat_khau' => Hash::make($data['password']),
                'loai_taikhoan_id' => 5, // 5 là ID của loại tài khoản người dùng bình thường
                'trang_thai' => 1, // 1 là trạng thái hoạt động
            ]);

            return redirect()->route('auth.login.form')->with('success', 'Bạn đã đăng ký thành công! Vui lòng đăng nhập.');
        } catch (ValidationException $e) {
            // Log validation errors
            Log::channel('login')->error('Register validation failed.', [
                'errors' => $e->errors()
            ]);
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            // Ghi log vào channel 'login'
            Log::channel('login')->error('An unexpected error occurred during register: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'stack' => $e->getTraceAsString(),
            ]);
            return back()->withErrors(['error-register' => 'Đã xảy ra lỗi trong quá trình đăng ký. Vui lòng thử lại sau.'])->withInput();
        }
    }

    public function generateRandomPassword(Request $request)
    {
        // Tạo mật khẩu ngẫu nhiên với các ký tự chữ thường, chữ hoa, số và ký tự đặc biệt
        $lowercase = 'abcdefghijklmnopqrstuvwxyz';
        $uppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $numbers = '0123456789';
        $customSymbols = '!@#$%^&*+=';

        $allCharacters = $lowercase . $uppercase . $numbers . $customSymbols;
        $length = 10;
        $password = '';

        // Hàm helper để chọn ngẫu nhiên một ký tự từ một chuỗi
        $getRandomChar = function ($charSet) {
            return $charSet[random_int(0, strlen($charSet) - 1)];
        };

        $password .= $getRandomChar($lowercase);
        $password .= $getRandomChar($uppercase);
        $password .= $getRandomChar($numbers);
        $password .= $getRandomChar($customSymbols);

        $remainingLength = $length - strlen($password);

        for ($i = 0; $i < $remainingLength; $i++) {
            $password .= $getRandomChar($allCharacters);
        }

        $password = str_shuffle($password);

        if ($request->ajax()) {
            return response()->json([
                'password' => $password
            ]);
        }
        return response()->json(['error' => 'Invalid request'], 400);
    }
    /**
     * Kiểm tra độ mạnh của mật khẩu
     *
     * @param string $password
     * @return string
     **/
    public function checkStrengthPassword(string $password): string
    {
        $strength = 0;

        // Độ dài tối thiểu 8 ký tự
        if (strlen($password) >= 8) {
            $strength++;
        }

        // Chữ hoa
        if (preg_match('/[A-Z]/', $password)) {
            $strength++;
        }

        // Chữ thường
        if (preg_match('/[a-z]/', $password)) {
            $strength++;
        }

        // Chữ số
        if (preg_match('/[0-9]/', $password)) {
            $strength++;
        }

        // Ký tự đặc biệt
        if (preg_match('/[!@#$%^&*(),.?":{}|<>]/', $password)) {
            $strength++;
        }

        // Đánh giá độ mạnh
        return match ($strength) {
            0, 1 => 1,
            2 => 2,
            3 => 3,
            4 => 4,
            default => 5,
        };
    }
}
