<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KhachHang extends Model
{
    protected $table = 'khach_hang'; // Tên bảng trong DB

    protected $primaryKey = 'id_khachhang'; // Khóa chính

    public $timestamps = false; // Nếu bạn không dùng created_at/update_at dạng mặc định

    protected $fillable = [
        'ho_ten',
        'vi_tri',
        'create_at',
        'update_at',
        'id_taikhoan',
        'anh_dai_dien'
    ];
}
