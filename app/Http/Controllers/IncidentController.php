<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IncidentController extends Controller
{
    public function index()
    {
        return view('forms.incident-report');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'device_name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $id = DB::table('yeu_cau')->insertGetId([
            'id_khach_hang' => 1,
            'ten_thiet_bi' => $validated['device_name'],
            'mo_ta' => $validated['description'],
            'trang_thai' => 'Chờ xử lý',
            'id_nhan_vien_duoc_phan_cong' => null,
            'create_at' => now(),
            'update_at' => now(),
            'kinh_do' => 1,
            'vi_do' => 1,
        ]);

        return redirect()->back()->with('success', 'Báo cáo đã được gửi thành công!');
    }
}
