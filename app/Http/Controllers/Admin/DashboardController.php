<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NhanVien;
use App\Models\YeuCau;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    // Lấy dữ liệu cho dashboard
    public function getDataForDashboard()
    {
        try {
            $listNhanVien = NhanVien::select(
                'id_nhanvien as id',
                'ho_ten',
                'trang_thai',
                'vi_do',
                'kinh_do',
            )
                ->where('trang_thai', '!=', 'Không trực tuyến')
                ->whereNotNull('trang_thai')
                ->get()
                ->map(fn($nv) => [
                    'id' => $nv->id,
                    'ho_ten' => $nv->ho_ten,
                    'trang_thai' => $nv->trang_thai,
                    'vi_do' => $nv->vi_do,
                    'kinh_do' => $nv->kinh_do,
                    'anh_dai_dien' => asset('').'assets/img/vnpt.jpg',
                    'loai' => 'employee'
                ]);
        } catch (\Exception $e) {
            $listNhanVien = [];
        }

        try {
            $listYeuCau = YeuCau::join('khach_hang', 'yeu_cau.id_khach_hang', '=', 'khach_hang.id_khachhang')
                ->select(
                    'yeu_cau.id_yeu_cau as id',
                    'khach_hang.ho_ten as ho_ten',
                    'yeu_cau.trang_thai as trang_thai',
                    'yeu_cau.vi_do as vi_do',
                    'yeu_cau.kinh_do as kinh_do',
                )
                ->where('yeu_cau.trang_thai', 'Chờ xử lý')
                ->get()
                ->map(fn($yc) => [
                    'id' => $yc->id,
                    'ho_ten' => $yc->ho_ten,
                    'trang_thai' => $yc->trang_thai,
                    'vi_do' => $yc->vi_do,
                    'kinh_do' => $yc->kinh_do,
                    'anh_dai_dien' => asset('').'assets/img/user.png',
                    'loai' => 'customer'
                ]);
        } catch (\Exception $e) {
            $listYeuCau = [];
        }

        $allData = $listNhanVien->concat($listYeuCau); // concat nhanh hơn merge

        // Đếm số lượng nhân viên và yêu cầu theo trạng thái
        $statusEmployeeCounts = [
            'truc_tuyen' => NhanVien::where('trang_thai', 'Trực tuyến')->count(),
            'dang_ban' => NhanVien::where('trang_thai', 'Đang bận')->count(),
            'khong_truc_tuyen' => NhanVien::where('trang_thai', 'Không trực tuyến')->count(),
        ];

        $requestCounts = YeuCau::where('trang_thai', 'Chờ xử lý')->count();

        $count = DB::table('hop_dong')
            ->whereDate('ngay_lap', DB::raw('CURDATE()'))
            ->count('id_hd');

        $countPhanHoi = DB::table('phan_hoi')
            ->where(function ($query) {
                $query->whereDate('create_at', DB::raw('CURDATE()'))
                    ->orWhereDate('update_at', DB::raw('CURDATE()'));
            })
            ->count('id_phanhoi');
        $countYeuCauChoDuyet = DB::table('yeu_cau')
            ->where('trang_thai', 'Chờ xử lý')
            ->count('id_yeu_cau');

        $countKhachHangHuy = DB::table('hop_dong')
            ->whereDate('ngay_huy', DB::raw('CURDATE()'))
            ->count('id_hd');
        $data = DB::table('yeu_cau')
            ->join('khach_hang', 'yeu_cau.id_khach_hang', '=', 'khach_hang.id_khachhang')
            ->leftjoin('nhan_vien', 'yeu_cau.id_nhan_vien_duoc_phan_cong', '=', 'nhan_vien.id_nhanvien')
            ->select(
                'khach_hang.ho_ten',
                'yeu_cau.ten_thiet_bi',
                'yeu_cau.mo_ta',
                'yeu_cau.trang_thai',
                'nhan_vien.ho_ten as ten_nhan_vien',
                'yeu_cau.create_at',
                'yeu_cau.update_at'
            )
            ->orderByDesc('yeu_cau.create_at')
            ->limit(10)
            ->get();

        // Trả về dữ liệu dưới dạng mảng
        return [
            'statusEmployeeCounts' => $statusEmployeeCounts,
            'requestCounts' => $requestCounts,
            'allData' => $allData,
            'count' => $count,
            'countPhanHoi' => $countPhanHoi,
            'countYeuCauChoDuyet' => $countYeuCauChoDuyet,
            'countKhachHangHuy' => $countKhachHangHuy,
            'data' => $data
        ];
    }

    // Hiển thị dashboard
    public function index()
    {
        // Truyền dữ liệu vào view
        return view('pages.admin.dashboard', $this->getDataForDashboard());
    }

    // API để lấy dữ liệu nhân viên và yêu cầu
    public function getEmployeeAndRequests(Request $request)
    {
        return response()->json([
            'status' => 'success',
            'data' => $this->getDataForDashboard()
        ]);
    }
}
