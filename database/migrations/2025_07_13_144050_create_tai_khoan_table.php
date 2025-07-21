// database/migrations/YYYY_MM_DD_HHMMSS_create_tai_khoans_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tai_khoan', function (Blueprint $table) {
            $table->id('id_taikhoan');
            // Các cột khác
            $table->string('mat_khau');
            $table->string('email', 100)->unique();
            $table->string('so_dien_thoai', 20)->nullable();
            $table->string('dia_chi')->nullable();

            // Khóa ngoại tới bảng 'loai_tai_khoan'
            $table->foreignId('loai_taikhoan_id')
                ->nullable()
                ->constrained('loai_tai_khoan', 'id_loaitaikhoan')
                ->onDelete('set null');

            $table->boolean('trang_thai')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tai_khoan');
    }
};
