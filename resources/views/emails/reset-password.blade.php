<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Đặt lại mật khẩu</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            
            color: white;
            padding: 20px;
            text-align: center;
        }
        .logo {
            margin-bottom: 15px;
            text-align: center;
        }
        .content {
            padding: 20px;
            background-color: #f9f9f9;
        }
        .button {
            display: inline-block;
            background-color: #0066b3;
            color: white !important;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 4px;
            margin: 20px 0;
            font-weight: bold;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">
                <img src="https://upload.wikimedia.org/wikipedia/vi/thumb/6/65/VNPT_Logo.svg/1551px-VNPT_Logo.svg.png" alt="VNPT Logo" width="120" style="display: inline-block;">
            </div>
            <h1>Đặt lại mật khẩu</h1>
        </div>
        <div class="content">
            <p>Xin chào {{ $userName }},</p>
            
            <p>Chúng tôi nhận được yêu cầu đặt lại mật khẩu cho tài khoản của bạn. Vui lòng nhấp vào nút bên dưới để đặt lại mật khẩu của bạn:</p>
            
            <div style="text-align: center;">
                <a href="{{ $resetUrl }}" class="button">Đặt lại mật khẩu</a>
            </div>
            
            <p>Nếu bạn không yêu cầu đặt lại mật khẩu, bạn có thể bỏ qua email này.</p>
            
            <p>Liên kết đặt lại mật khẩu sẽ hết hạn sau 60 phút.</p>
            
            <p>Nếu bạn gặp sự cố khi nhấp vào nút "Đặt lại mật khẩu", hãy sao chép và dán URL bên dưới vào trình duyệt web của bạn:</p>
            
            <p>{{ $resetUrl }}</p>
            
            <p>Trân trọng,<br>Đội ngũ VNPT</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} VNPT. Tất cả các quyền được bảo lưu.</p>
        </div>
    </div>
</body>
</html> 