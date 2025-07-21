<style>
    /* HEADER NAVBAR STYLE */
    .navbar {
        background: linear-gradient(90deg, #006dc1, #008eec);
        padding: 1.2rem 0;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        position: sticky;
        top: 0;
        z-index: 1000;
    }

    /* TOGGLER BUTTON (mobile) */
    .navbar-toggler {
        border: none;
        padding: 0.6rem;
        transition: transform 0.3s ease;
    }

    .navbar-toggler:hover {
        transform: scale(1.1);
    }

    .navbar-toggler-icon {
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3E%3Cpath stroke='%23ffffff' stroke-width='2' stroke-linecap='round' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
    }

    /* Hiện menu con */
    /* Dropdown tùy chỉnh */
    .custom-dropdown {
        min-width: 240px;
        border-radius: 12px;
        padding: 0.5rem 0;
        background-color: #fff;
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }

    /* Item trong dropdown */
    .custom-dropdown .dropdown-item {
        padding: 12px 18px;
        font-weight: 500;
        font-size: 15px;
        color: #333;
        transition: all 0.2s ease-in-out;
        border-radius: 8px;
    }

    .custom-dropdown .dropdown-item:hover {
        background-color: #f5f5f5;
        color: #007bff;
    }

    /* Mobile: giữ behavior bootstrap */
    @media (max-width: 991.98px) {
        .dropdown-menu {
            border-radius: 0;
            box-shadow: none;
        }

        .custom-dropdown .dropdown-item {
            padding: 10px 16px;
        }
    }

    /* LOGO & TEXT */
    .navbar-brand {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        transition: transform 0.3s ease-in-out;
    }

    .navbar-brand:hover {
        transform: scale(1.03);
    }

    .navbar-brand img {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        box-shadow: 0 3px 6px rgba(0, 0, 0, 0.2);
    }

    .navbar-brand h4 {
        margin: 0;
        font-size: 1.5rem;
        font-weight: 600;
        line-height: 1.2;
        color: #ffffff;
    }

    .navbar-brand h4 .fw-semibold {
        color: #ffffff;
    }

    .navbar-brand h4 .fw-bold {
        color: #cfefff;
    }

    /* NAV LINKS */
    .navbar-nav .nav-link {
        font-size: 1.1rem;
        font-weight: 500;
        color: #ffffff !important;
        padding: 0.6rem 1.2rem;
        position: relative;
        transition: color 0.3s ease, transform 0.2s ease;
    }

    .navbar-nav .nav-link:hover {
        color: #bce4ff !important;
        transform: translateY(-1px);
    }

    /* HOVER UNDERLINE */
    .navbar-nav .nav-link::after {
        content: "";
        position: absolute;
        width: 0;
        height: 2px;
        bottom: 0;
        left: 50%;
        background: #bce4ff;
        transition: width 0.3s ease, left 0.3s ease;
    }

    .navbar-nav .nav-link:hover::after {
        width: 100%;
        left: 0;
    }

    /* LOGIN BUTTON */
    .navbar .btn-primary {
        background: #ffffff;
        color: #006dc1;
        border: none;
        padding: 0.6rem 1.8rem;
        border-radius: 50px;
        font-size: 1rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
    }

    .navbar .btn-primary:hover {
        background: #e0f3ff;
        color: #004b99;
        transform: scale(1.05);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
    }

    /* RESPONSIVE NAVBAR */
    @media (max-width: 991.98px) {
        .navbar-nav {
            padding: 1rem 0;
            text-align: center;
        }

        .navbar-nav .nav-link {
            padding: 0.8rem 0;
        }

        .navbar .btn-primary {
            margin: 1rem auto;
            width: fit-content;
        }

        .navbar-brand h4 {
            font-size: 1.3rem;
        }

        .navbar-brand img {
            width: 45px;
            height: 45px;
        }
    }
</style>

<!-- HEADER -->
<nav class="navbar navbar-expand-lg bg-white shadow-sm py-3">
    <div class="container">
        <!-- Logo -->
        <a href="/" class="d-flex align-items-center text-decoration-none gap-2">
            <img src="{{ asset('assets/img/vnpt.jpg') }}" alt="VNPT Logo" class="rounded-circle shadow-sm"
                style="width: 45px; height: 45px;">
            <h4 class="mb-0">
                <span class="fw-semibold" style="color: #00BFFF;">VNPT</span>
                <span class="fw-bold" style="color: #FFC107;">Support</span>
            </h4>
        </a>

        <!-- Toggle trên mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu điều hướng -->
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav align-items-center gap-lg-3">
                <!-- Thông báo -->
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" id="notiDropdown">
                        <div class="position-relative d-inline-block">
                            <i class="bi bi-bell fs-5"></i>
                            <span
                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                                id="notification-badge">40</span>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm"
                        style="width: 300px; max-height: 400px; overflow-y: auto;" id="notification-list">
                        <li class="px-3 py-2 text-muted">Không có thông báo mới.</li>
                    </ul>
                </li>

                <!-- Tính năng -->
                <li class="nav-item dropdown position-relative">
                    <a class="nav-link fw-medium d-flex align-items-center gap-1" href="#" id="featureDropdown"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Tính năng
                        <i class="bi bi-caret-down-fill small"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow border-0 animate__animated animate__fadeIn custom-dropdown"
                        aria-labelledby="featureDropdown">
                        <li>
                            <a class="dropdown-item d-flex align-items-center gap-2" href="#feature-booking">
                                <i class="bi bi-calendar2-check text-primary"></i> Đặt lịch hỗ trợ
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center gap-2" href="#feature-history">
                                <i class="bi bi-clock-history text-warning"></i> Lịch sử yêu cầu
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center gap-2" href="#feature-rating">
                                <i class="bi bi-star-half text-success"></i> Đánh giá dịch vụ
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Dịch vụ -->
                <li class="nav-item">
                    <a class="nav-link fw-medium" href="#services">Dịch vụ</a>
                </li>

                <!-- Liên hệ -->
                <li class="nav-item">
                    <a class="nav-link fw-medium" href="#footer">Liên hệ</a>
                </li>

                <!-- Đăng nhập -->
                <li class="nav-item">
                    @if(Auth::check())
                    <a href="#" class="btn btn-primary rounded-pill px-4">Trang cá nhân</a>
                    @else
                    <a href="/auth/login" class="btn btn-primary rounded-pill px-4">
                        <i class="bi bi-box-arrow-in-right"></i> Đăng nhập
                    </a>
                    @endif
                </li>

                <!-- Tài khoản -->
                {{-- <li class="nav-item dropdown">
                    <!-- Nút tài khoản -->
                    <a class="btn btn-primary rounded-pill px-4 dropdown-toggle d-flex align-items-center gap-2"
                        href="#" id="accountDropdown" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="bi bi-person-circle"></i> Tài khoản
                    </a>

                    <!-- Dropdown tài khoản -->
                    <ul class="dropdown-menu dropdown-menu-end p-3 border-0 shadow-lg rounded-4"
                        aria-labelledby="accountDropdown" style="width: 280px;">

                        <!-- Avatar + Tên người dùng -->
                        <li class="d-flex align-items-center mb-3">
                            <img src="https://i.pravatar.cc/60" alt="avatar" class="rounded-circle me-3 shadow-sm"
                                width="50" height="50">
                            <div>
                                <strong class="d-block text-dark">Nguyễn Văn A</strong>
                                <small class="text-muted">nguyenvana@example.com</small>
                            </div>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <!-- Nút chức năng -->
                        <li>
                            <a href="/profile" class="dropdown-item d-flex align-items-center gap-2 py-2">
                                <i class="bi bi-person-lines-fill text-primary"></i> Trang cá nhân
                            </a>
                        </li>
                        <li>
                            <a href="/logout" class="dropdown-item d-flex align-items-center gap-2 py-2 text-danger">
                                <i class="bi bi-box-arrow-right"></i> Đăng xuất
                            </a>
                        </li>
                    </ul>
                </li> --}}
            </ul>
        </div>
    </div>
</nav>