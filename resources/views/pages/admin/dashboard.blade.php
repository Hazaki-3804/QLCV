{{-- Kế thừa từ layout admin --}}
@extends('layouts.admin')

{{-- Đặt tiêu đề trang --}}
@section('title', 'Trang chủ')

{{-- Nội dung chính của trang --}}
@section('content')
    <!--begin::App Content-->
    <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <!--begin::Col-->
                {{-- Hiển thị trạng thái nhân viên và yêu cầu gần đây --}}
                <!-- Nhân viên Trực tuyến -->
                <div class="col-lg-3 col-6">
                    <div class="small-box text-bg-success">
                        <div class="inner">
                            <h3>{{ $statusEmployeeCounts['truc_tuyen'] }}</h3>
                            <p>Nhân Viên Trực Tuyến</p>
                        </div>
                        <div style="text-align: center;">
                            <i class="bi bi-person-check-fill small-box-icon" style="font-size: 60px;"></i>
                        </div>
                        <a href="#"
                            class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                            Chi Tiết <i class="bi bi-link-45deg"></i>
                        </a>
                    </div>
                </div>

                <!-- Nhân viên Đang bận -->
                <div class="col-lg-3 col-6">
                    <div class="small-box text-bg-danger">
                        <div class="inner">
                            <h3>{{ $statusEmployeeCounts['dang_ban'] }}</h3>
                            <p>Nhân Viên Đang Bận</p>
                        </div>
                        <div style="text-align: center;">
                            <i class="bi bi-person-dash-fill small-box-icon" style="font-size: 60px;"></i>
                        </div>
                        <a href="#"
                            class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                            Chi Tiết <i class="bi bi-link-45deg"></i>
                        </a>
                    </div>
                </div>

                <!-- Nhân viên Không trực tuyến -->
                <div class="col-lg-3 col-6">
                    <div class="small-box text-bg-secondary">
                        <div class="inner">
                            <h3>{{ $statusEmployeeCounts['khong_truc_tuyen'] }}</h3>
                            <p>Không Trực Tuyến</p>
                        </div>
                        <div style="text-align: center;">
                            <i class="bi bi-person-x-fill small-box-icon" style="font-size: 60px;"></i>
                        </div>
                        <a href="#"
                            class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                            Chi Tiết <i class="bi bi-link-45deg"></i>
                        </a>
                    </div>
                </div>

                <!-- Yêu cầu chờ xử lý -->
                <div class="col-lg-3 col-6">
                    <div class="small-box text-bg-warning">
                        <div class="inner">
                            <h3>{{ $requestCounts }}</h3>
                            <p>Yêu Cầu Chờ Xử Lý</p>
                        </div>
                        <div style="text-align: center;">
                            <i class="bi bi-clock-fill small-box-icon" style="font-size: 60px;"></i>
                        </div>
                        <a href="#"
                            class="small-box-footer link-dark link-underline-opacity-0 link-underline-opacity-50-hover">
                            Chi Tiết <i class="bi bi-link-45deg"></i>
                        </a>
                    </div>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--table-->
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Danh sách yêu cầu gần đây</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th>Khách hàng</th>
                                    <th>Thiết bị</th>
                                    <th>Mô tả</th>
                                    <th>Trạng thái</th>
                                    <th>Nhân viên</th>
                                    <th>Ngày tạo</th>
                                    <th>Ngày cập nhật</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $row)
                                    <tr>
                                        <td>{{ $row->ho_ten }}</td>
                                        <td>{{ $row->ten_thiet_bi }}</td>
                                        <td>{{ $row->mo_ta }}</td>
                                        <td>
                                            @switch($row->trang_thai)
                                                @case('Chờ xử lý')
                                                    <span class="badge text-bg-warning">Chờ xử lý</span>
                                                @break

                                                @case('Đang xử lý')
                                                    <span class="badge text-bg-info">Đang xử lý</span>
                                                @break

                                                @case('Hoàn thành')
                                                    <span class="badge text-bg-success">Hoàn thành</span>
                                                @break

                                                @default
                                                    <span class="badge text-bg-secondary">{{ $yeucau->trang_thai }}</span>
                                            @endswitch
                                        </td>

                                        <td>{{ $row->ten_nhan_vien ?? 'Chưa phân công' }}</td>
                                        <td>{{ \Carbon\Carbon::parse($row->create_at)->format('d/m/Y H:i') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($row->update_at)->format('d/m/Y H:i') }}</td>
                                    </tr>
                                @endforeach
                                @if ($data->isEmpty())
                                    <tr>
                                        <td colspan="7" class="text-center text-muted">Không có dữ liệu</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!--end table-->
            <div class="my-4"></div>
            <!--begin::Row-->
            {{-- Hiển thị bản đồ --}}
            <div class="col-12 mt-1">
                <div id="map" class="min-vh-100 rounded-3"></div>
            </div>
            <!-- /.row (main row) -->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content-->

    <!--begin::Script-->
    <!-- OPTIONAL SCRIPTS -->
    <!-- ECharts CDN -->
    <script src="https://cdn.jsdelivr.net/npm/echarts@5.5.0/dist/echarts.min.js"></script>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}" />

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <!-- MarkerCluster CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.Default.css">

    <!-- MarkerCluster JS -->
    <script src="https://unpkg.com/leaflet.markercluster@1.5.3/dist/leaflet.markercluster.js"></script>

    <!-- Data JS -->
    <script>
        const allData = @json($allData);
    </script>

    {{-- CUSTOM SCRIPT --}}
    <script src="{{ asset('js/dashboard.js') }}"></script>
    <!--end::Script-->

@endsection
