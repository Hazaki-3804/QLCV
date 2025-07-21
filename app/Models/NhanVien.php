<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NhanVien extends Model
{
    protected $table = 'nhan_vien'; // tên bảng trong CSDL

    protected $primaryKey = 'id_nhanvien'; // khoá chính

    public $timestamps = false; // nếu không dùng created_at, updated_at mặc định của Laravel

    protected $fillable = [
        'ho_ten',
        'chuc_vu',
        'don_vi',
        'create_at',
        'update_at',
        'id_chinhanh',
        'id_khuvuc',
        'id_taikhoan',
        'kinh_do',
        'vi_do',
        'trang_thai',
        'anh_dai_dien',
    ];
}
