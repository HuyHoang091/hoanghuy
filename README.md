Lưu ý: Để chạy được wed 
 
Sửa file cấu hình: sudo vi /etc/php/php.ini 
Di chuyển xuống đến Module Setting sửa dòng date.timezone(xóa dấu ; ở đẩu sau đó thêm “Asia/Ho_Chi_Minh” sau dấu =) 
 
Cài đặt Node.js   
curl -sL https://rpm.nodesource.com/setup_16.x | sudo bash -  
sudo yum install -y nodejs  
Sau đó  
cd /var/www/html/hoanghuy/qr-access  
Rồi nhập node server.js 
