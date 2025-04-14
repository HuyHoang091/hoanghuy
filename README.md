Lưu ý: Để chạy ổn wed!!! 
 
Sửa file cấu hình: sudo vi /etc/php/php.ini 
Di chuyển xuống đến Module Setting sửa dòng date.timezone(xóa dấu ; ở đẩu sau đó thêm “Asia/Ho_Chi_Minh” sau dấu =) 
 
Cấu hình ip tĩnh 192.168.10.190  
Vào file sudo vi /etc/sysconfig/network-scripts/ifcfg-enp0s3  
Sửa thành:  
![image](https://github.com/user-attachments/assets/8621276f-2f5c-4176-b59a-5e002732c8b9)  
 
Cài đặt Node.js   
curl -sL https://rpm.nodesource.com/setup_16.x | sudo bash -  
sudo yum install -y nodejs  
Sau đó  
cd /var/www/html/hoanghuy/qr-access  
Rồi nhập node server.js 
