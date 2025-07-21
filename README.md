## Khi clone repo về cần 
composer install

## Tạo .env và copy từ .env.example 
### Trên Window PowerShell
Copy-Item -Path .env.example -Destination .env
### Trên Linux/MacOS
cp .env.example .env
### Trên Windows Command Prompt (CMD):
copy .env.example .env
### Lệnh tạo APP_KEY mới
php artisan key:generate

## Chạy server 
php artisan serve
