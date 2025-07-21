<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class TaiKhoan extends Authenticatable
{
    use Notifiable, HasFactory;

    protected $table = 'tai_khoan';
    protected $primaryKey = 'id_taikhoan';
    public $timestamps = true;

    protected $fillable = [
        'email',
        'ten_nguoi_dung',
        'mat_khau',
        'so_dien_thoai',
        'dia_chi',
        'loai_taikhoan_id',
        'trang_thai',
        'created_at',
        'updated_at',
    ];

    protected $hidden = [
        'mat_khau',
        'remember_token',
    ];

    public function getAuthPassword()
    {
        return $this->mat_khau;
    }

    public function getAuthIdentifierName()
    {
        return 'email';
    }
}
