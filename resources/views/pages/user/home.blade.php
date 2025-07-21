@extends('layouts.user')

@section('title', 'Trang chủ VNPT Support')

@section('content')
<!-- Custom CSS -->
<link rel="stylesheet" href="{{ asset('css/home.css') }}">

<!-- HERO -->
<section class="hero-section py-5 text-center position-relative overflow-hidden">
    <!-- Background particles -->
    <div id="particles-js" class="particle-bg"></div>

    <!-- Nội dung chính -->
    <div class="container position-relative z-1">
        <div class="hero-content">
            <h1 class="display-4 fw-bold text-white mb-4 animate__animated animate__fadeInDown">
                <span class="text-gradient">VNPT</span> – Đồng hành chuyển đổi số
            </h1>
            <p class="lead text-light mb-4 animate__animated animate__fadeInUp animate__delay-1s">
                Đặt lịch hỗ trợ nhanh chóng, theo dõi tiến trình trực tuyến, kết nối thông minh với đội ngũ kỹ thuật
                chuyên nghiệp
            </p>
            <div class="hero-buttons mt-4">
                <a href="#features"
                    class="btn btn-primary btn-lg shadow-lg animate__animated animate__zoomIn animate__delay-2s">
                    Bắt đầu ngay
                </a>
                <a href="#footer"
                    class="btn btn-outline-light btn-lg ms-3 animate__animated animate__zoomIn animate__delay-2s gradient-border">
                    Liên hệ hỗ trợ
                </a>
            </div>
        </div>
    </div>
</section>

<!-- FEATURES -->
<section id="features" class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center fw-bold mb-5 text-primary">Tính năng người dùng</h2>
        <div class="row text-center g-4">
            <!-- Tính năng 1: Đặt lịch -->
            <div class="col-md-4">
                <div class="feature-card border rounded p-4 shadow-sm h-100">
                    <img src="https://cdn-icons-png.flaticon.com/512/3502/3502458.png" width="60" alt="Đặt lịch">
                    <h5 class="mt-3 fw-semibold">Đặt lịch hỗ trợ kỹ thuật</h5>
                    <p>Chọn dịch vụ, thời gian và gửi yêu cầu hỗ trợ nhanh chóng chỉ với vài thao tác.</p>
                    <a href="/dat-lich" class="btn btn-primary mt-2">Đặt lịch ngay</a>
                </div>
            </div>

            <!-- Tính năng 2: Theo dõi & Lịch sử -->
            <div class="col-md-4">
                <div class="feature-card border rounded p-4 shadow-sm h-100">
                    <img src="https://cdn-icons-png.flaticon.com/512/684/684908.png" width="60"
                        alt="Theo dõi yêu cầu">
                    <h5 class="mt-3 fw-semibold">Theo dõi và quản lý lịch sử</h5>
                    <p>Xem yêu cầu đã gửi, tiến độ xử lý và vị trí kỹ thuật viên theo thời gian thực.</p>
                    <a href="/lich-su-yeu-cau" class="btn btn-primary mt-2">Xem lịch sử</a>
                </div>
            </div>

            <!-- Tính năng 3: Đánh giá -->
            <div class="col-md-4">
                <div class="feature-card border rounded p-4 shadow-sm h-100">
                    <img src="https://cdn-icons-png.flaticon.com/512/2107/2107957.png" width="60" alt="Đánh giá">
                    <h5 class="mt-3 fw-semibold">Đánh giá dịch vụ</h5>
                    <p>Để lại nhận xét, đánh giá kỹ thuật viên sau mỗi lần sử dụng dịch vụ.</p>
                    <a href="/danh-gia-dich-vu" class="btn btn-primary mt-2">Gửi đánh giá</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SERVICES -->
<section id="services" class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center fw-bold text-primary mb-5">Dịch vụ kỹ thuật VNPT</h2>
        <div class="row g-4">
            <!-- Dịch vụ 1 -->
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body text-center">
                        <img src="https://cdn-icons-png.flaticon.com/512/748/748137.png" width="60" alt="WiFi"
                            class="mb-3">
                        <h5 class="card-title fw-semibold">Sửa chữa và nâng cấp WiFi</h5>
                        <p class="card-text">Khắc phục lỗi kết nối, nâng cấp thiết bị mạng cho tốc độ cao và ổn
                            định.</p>
                    </div>
                </div>
            </div>

            <!-- Dịch vụ 2 -->
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body text-center">
                        <img src="https://cdn-icons-png.flaticon.com/512/2609/2609282.png" width="60" alt="Camera"
                            class="mb-3">
                        <h5 class="card-title fw-semibold">Lắp đặt & bảo trì Camera</h5>
                        <p class="card-text">Tư vấn, lắp đặt hệ thống giám sát an ninh chất lượng cao cho hộ gia
                            đình và doanh nghiệp.</p>
                    </div>
                </div>
            </div>

            <!-- Dịch vụ 3 -->
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body text-center">
                        <img src="https://cdn-icons-png.flaticon.com/512/854/854866.png" width="60"
                            alt="Truyền hình" class="mb-3">
                        <h5 class="card-title fw-semibold">Hỗ trợ Truyền hình & thiết bị</h5>
                        <p class="card-text">Cài đặt đầu thu, sửa lỗi tín hiệu truyền hình VNPT, hỗ trợ các thiết
                            bị đi kèm.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- APPS SECTION -->
<div class="apps py-5" style="background:#0072ce;">
    <div class="container">
        <div class="d-flex align-items-center mb-4">
            <img src="https://vnpt.com.vn/design/images/icon-phone.png" width="18" height="28" class="me-2"
                alt="Ứng dụng">
            <span class="fs-5 fw-bold text-white">Các ứng dụng</span>
        </div>

        <div class="row g-4">
            <!-- VinaPhone Plus -->
            <div class="col-12 col-md-6 col-lg-4">
                <div class="app-card bg-white rounded-4 p-4 h-100 d-flex flex-column align-items-center">
                    <img src="https://vnpt.com.vn/design/images/logo-vinphone-plus.jpg" alt="Vinaphone Plus"
                        class="mb-3" style="width:90px;height:90px;border-radius:20px;">
                    <h5 class="fw-bold">VinaPhone Plus</h5>
                    <a href="#" onclick="getVinaphonePlus()"
                        class="btn btn-primary rounded-pill px-4 mb-2">Download</a>
                    <p class="text-secondary text-center small mb-0">
                        Ứng dụng chăm sóc khách hàng của VinaPhone, cung cấp hàng ngàn ưu đãi cho khách hàng.
                    </p>
                </div>
            </div>

            <!-- My VNPT -->
            <div class="col-12 col-md-6 col-lg-4">
                <div class="app-card bg-white rounded-4 p-4 h-100 d-flex flex-column align-items-center">
                    <img src="https://vnpt.com.vn/design/images/logo_app_myvnpt.png" alt="My VNPT" class="mb-3"
                        style="width:90px;height:90px;border-radius:20px;">
                    <h5 class="fw-bold">My VNPT</h5>
                    <a href="#" onclick="getMyVNPT()"
                        class="btn btn-primary rounded-pill px-4 mb-2">Download</a>
                    <p class="text-secondary text-center small mb-0">
                        Ứng dụng tra cứu toàn bộ thông tin thuê bao, lịch sử tiêu dùng, gói cước, dịch vụ… của VNPT.
                    </p>
                </div>
            </div>

            <!-- VNPT Money -->
            <div class="col-12 col-md-6 col-lg-4">
                <div class="app-card bg-white rounded-4 p-4 h-100 d-flex flex-column align-items-center">
                    <img src="https://vnpt.com.vn/design/images/logo-vnpt-app_money.png" alt="VNPT Money"
                        class="mb-3" style="width:90px;height:90px;border-radius:20px;">
                    <h5 class="fw-bold">VNPT Money</h5>
                    <a href="#" onclick="getVNPTMoney()"
                        class="btn btn-primary rounded-pill px-4 mb-2">Download</a>
                    <p class="text-secondary text-center small mb-0">
                        VNPT Money chuyển tiền miễn phí thanh toán mọi lúc. Nhiều chương trình ưu đãi, khuyến mãi.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- SCRIPT -->
<script src="{{ asset('js/home.js') }}"></script>
@endsection