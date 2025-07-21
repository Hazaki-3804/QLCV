<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class TaiKhoanFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'email' => fake()->unique()->safeEmail(),
            'so_dien_thoai' => fake()->unique()->phoneNumber(),
            'dia_chi' => fake()->address(),
            'loai_taikhoan_id' => null, // Giả sử không có loại tài khoản cụ thể
            'trang_thai' => true, // Mặc định là hoạt động
            'created_at' => now(),
            'updated_at' => now(),
            // Mật khẩu sẽ được tạo ngẫu nhiên nếu chưa có
            'mat_khau' => static::$password ??= Hash::make('password'), //
        ];
    }
}
