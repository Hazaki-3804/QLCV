<?php

namespace Database\Seeders;

use App\Models\TaiKhoan;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        TaiKhoan::factory()->create([
            'email' => 'test@example.com',
            'mat_khau' => Hash::make('password'), // Mật khẩu đã được mã hóa
            'so_dien_thoai' => '0123456789',
            'dia_chi' => '123 Đường ABC, Quận 1, TP. Hồ Chí Minh',
            'loai_taikhoan_id' => 1,
            'trang_thai' => true,
        ]);
    }
}
