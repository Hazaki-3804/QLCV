<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class YeuCau extends Authenticatable
{
    protected $guard = [];
    protected $table = 'yeu_cau'; // Tên bảng

    protected $primaryKey = 'id_yeu_cau'; // Khóa chính

    public $timestamps = false; // Vì bạn đang dùng create_at/update_at (không phải created_at/updated_at)

    protected $fillable = [
        'id_khach_hang',
        'ten_thiet_bi',
        'mo_ta',
        'trang_thai',
        'id_nhan_vien_duoc_phan_cong',
        'create_at',
        'update_at',
        'kinh_do',
        'vi_do'
    ];
}
