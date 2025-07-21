<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Form Báo Cáo Sự Cố Internet VNPT</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
  <div class="card shadow-lg rounded-4">
    <div class="card-header bg-primary text-white text-center">
      <h4 class="mb-0">BÁO CÁO SỰ CỐ INTERNET VNPT</h4>
    </div>
    <div class="card-body">
      <form method="POST" action="{{ route('incident.store') }}">
        @csrf
        <div class="mb-3">
          <label for="name" class="form-label">Họ tên</label>
          <input type="text" class="form-control" id="name" placeholder="" required>
        </div>

        <div class="mb-3">
          <label for="phone" class="form-label">Số điện thoại</label>
          <input type="tel" class="form-control" id="phone" placeholder="" required>
        </div>

        <div class="mb-3">
          <label for="address" class="form-label">Địa chỉ</label>
          <input type="text" class="form-control" id="address" placeholder="" required>
        </div>

        <div class="mb-3">
          <label for="device_name" class="form-label">Tên thiết bị</label>
          <input type="text" class="form-control" id="device_name" name="device_name" placeholder="Modem VNPT, Router TP-Link..." required>
        </div>

        <div class="mb-3">
          <label for="description" class="form-label">Mô tả sự cố</label>
          <textarea class="form-control" id="description" name="description" rows="4" placeholder="Mô tả chi tiết sự cố..." required></textarea>
        </div>

        <div class="text-center">
          <button type="submit" class="btn btn-primary px-4 rounded-pill">Gửi báo cáo</button>
        </div>
      </form>
    </div>
    <div class="card-footer text-center text-muted small">
      VNPT hỗ trợ kỹ thuật 24/7 - Tổng đài: 1800 1166
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
