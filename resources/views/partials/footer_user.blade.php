<style>
    /* SUB FOOTER */
    .icon-circle {
        width: 64px;
        height: 64px;
        background-color: #fff;
        border: 2px solid #dee2e6;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .icon-circle img {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 50%;
    }

    .icon-circle:hover {
        box-shadow: 0 0 8px rgba(0, 123, 255, 0.3);
        transform: scale(1.05);
    }

    #scrollToTopBtn {
        position: fixed;
        bottom: 24px;
        right: 24px;
        width: 52px;
        height: 52px;
        border: none;
        border-radius: 50%;
        background-color: #005ab4;
        /* Xanh đậm */
        color: #ffffff;
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 1050;
        cursor: pointer;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }

    #scrollToTopBtn:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 28px rgba(0, 0, 0, 0.4);
    }

    #scrollToTopBtn::after {
        content: "";
        position: absolute;
        bottom: -8px;
        left: 50%;
        transform: translateX(-50%);
        width: 60%;
        height: 8px;
        background: rgba(0, 0, 0, 0.2);
        filter: blur(4px);
        border-radius: 50%;
        z-index: -1;
    }
</style>

<!-- SUB FOOTER -->
<div class="sub-footer bg-body-tertiary py-5 border-top">
    <div class="container">
        <div class="row align-items-center justify-content-between">
            <div class="col-lg-10 col-12">
                <ul class="row row-cols-2 row-cols-md-5 g-4 list-unstyled mb-0">
                    <!-- Mỗi mục -->
                    <li class="col text-center">
                        <div class="d-flex flex-column align-items-center">
                            <div class="icon-circle mb-2">
                                <img src="https://vnpt.com.vn/Design/images/footer_icon2.jpg" alt="Hotline">
                            </div>
                            <div class="fw-semibold small text-primary">
                                <a href="tel:18001091" class="text-decoration-none text-primary">18001091</a> |
                                <a href="tel:18001166" class="text-decoration-none text-primary">18001166</a> |
                                <a href="tel:18001260" class="text-decoration-none text-primary">18001260</a>
                            </div>
                        </div>
                    </li>

                    <li class="col text-center">
                        <div class="d-flex flex-column align-items-center">
                            <div class="icon-circle mb-2">
                                <img src="https://vnpt.com.vn/Design/images/footer_icon3.jpg" alt="Email">
                            </div>
                            <div class="fw-semibold small">
                                <a href="mailto:cskh@vnpt.vn" class="text-decoration-none text-primary">cskh@vnpt.vn</a>
                            </div>
                        </div>
                    </li>

                    <li class="col text-center">
                        <div class="d-flex flex-column align-items-center">
                            <div class="icon-circle mb-2">
                                <img src="https://vnpt.com.vn/design/images/footer_icon5.jpg" alt="Q&A">
                            </div>
                            <div class="fw-semibold small">
                                <a href="/tu-van" class="text-decoration-none text-primary">Q&amp;A</a>
                            </div>
                        </div>
                    </li>

                    <li class="col text-center">
                        <div class="d-flex flex-column align-items-center">
                            <div class="icon-circle mb-2">
                                <img src="https://vnpt.com.vn/design/images/footer_icon5.jpg" alt="Chính sách">
                            </div>
                            <div class="fw-semibold small">
                                <a href="/nghi-dinh-13-ve-bao-ve-du-lieu-ca-nhan"
                                    class="text-decoration-none text-primary">Chính sách bảo vệ dữ liệu cá nhân</a>
                            </div>
                        </div>
                    </li>

                    <li class="col text-center">
                        <div class="d-flex flex-column align-items-center">
                            <div class="icon-circle mb-2">
                                <img src="https://vnpt.com.vn/design/images/footer_icon4.jpg" alt="Điều khoản">
                            </div>
                            <div class="fw-semibold small">
                                <a href="/ve-vinaphone/dieu-khoan-su-dung"
                                    class="text-decoration-none text-primary">Điều khoản</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>

            <div class="col-lg-2 col-12 text-center mt-4 mt-lg-0">
                <img src="https://vnpt.com.vn/design/images/certify_vnpt.png" alt="ĐÃ THÔNG BÁO BỘ CÔNG THƯƠNG"
                    class="img-fluid mb-2">
                <div class="small fw-medium text-secondary">ĐƯỢC CHỨNG NHẬN</div>
            </div>
        </div>
    </div>
</div>

<!-- FOOTER -->
<div id="footer" style="background:#0072ce; color:#fff;">
    <div class="container py-4">
        <div class="row">
            <div class="col-md-8 col-12 mb-3 mb-md-0">
                <div class="d-flex align-items-center mb-2">
                    <img src="https://vnpt.com.vn/design/images/logo_footer.png" alt="VNPT VinaPhone"
                        style="height:40px;" class="me-2">
                </div>
                <div class="small lh-lg">
                    VNPT VinaPhone © 2019.<br>
                    Giấy phép số: 62/GP-TTĐT do Bộ Thông tin - Truyền thông cấp ngày 09/04/2019.<br>
                    Tập đoàn Bưu chính Viễn thông Việt Nam<br>
                    Trụ sở: Tòa nhà VNPT, 57 Huỳnh Thúc Kháng, phường Láng, Hà Nội<br>
                    Mã số doanh nghiệp: 0100684378 do Sở Kế hoạch và Đầu tư TP.Hà Nội cấp ngày 22/10/2018<br>
                    Giấy phép cung cấp dịch vụ viễn thông số 469/GP-BTTTT do Bộ Thông tin và Truyền thông cấp ngày
                    14/10/2016<br>
                    Giấy phép cung cấp dịch vụ viễn thông số 18/GP-CVT do Bộ Thông tin và Truyền thông cấp ngày
                    18/01/2018
                </div>
            </div>
            <div class="col-md-4 col-12 text-md-end text-center">
                <div class="mb-2">Theo dõi chúng tôi:
                    <!-- Facebook -->
                    <a href="https://www.facebook.com/vinaphonefan" target="_blank" class="ms-2"
                        aria-label="Facebook">
                        <img src="https://vnpt.com.vn/design/images/fb-icon.png" alt="Facebook" width="28"
                            height="28" class="rounded-circle shadow" />
                    </a>

                    <!-- YouTube -->
                    <a href="https://www.youtube.com/channel/UCCrkSbaFcot6hcLOuNADX8Q" target="_blank" class="ms-2"
                        aria-label="YouTube">
                        <img src="https://vnpt.com.vn/design/images/youtube-icon.jpg" alt="YouTube" width="28"
                            height="28" class="rounded-circle shadow" />
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Nút Scroll to Top -->
    <button id="scrollToTopBtn" class="btn shadow">
        <i class="bi bi-chevron-up fs-5"></i>
    </button>

    <!-- JavaScript tự động ẩn/hiện -->
    <script>
        window.addEventListener("scroll", () => {
            const btn = document.getElementById("scrollToTopBtn");
            if (window.scrollY > 200) {
                btn.style.display = "flex";
            } else {
                btn.style.display = "none";
            }
        });

        document.getElementById("scrollToTopBtn").onclick = () => {
            window.scrollTo({
                top: 0,
                behavior: "smooth"
            });
        };
    </script>
</div>
