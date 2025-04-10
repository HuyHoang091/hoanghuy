<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .phan {
            /* display: grid; */
            margin: 100px 20%;
            background: white;
            /* height: 750px; */
            border-radius: 15px;
            font-family: apple-system, BlinkMacSystemFont, "Segoe UI", Tahoma, Helvetica, sans-serif;
            padding: 17px;
        }
        body {
            background: #ecf0f5;
        }
        .btn {
            width: 50%;
            padding: 10px;
            border-radius: 9px;
            border: 1px solid #0000002b;
            background-clip: content-box;
            outline: none;
            margin-top: 5px;
            margin-bottom: 10px;
        }
        .up {
            padding: 7px 20px; 
            border-radius: 15px; 
            margin-top: 20px; 
            cursor: pointer; 
            background: #ecf0f5;
            border: none;
        }
        .up:hover {
            background: #979797;
            color: white;
        }
        .edit-button {
            background: none;
            border: none;
            cursor: pointer;
            padding: 5px;
            font-size: 12px; /* Điều chỉnh kích thước của icon */
            color: #000; /* Màu sắc của icon */
            margin-left: 5px;
        }
        .btnsua{
            padding: 10px 60px;
            margin-top: 25px;
            background-color: #e4e7f7;
            color: #6680ff;
            border: none;
            border-radius: 15px;
            font-weight: 600;
            font-size: 16px;
            cursor: pointer;
            margin-bottom: 15px;
        }
        .btnsua:hover{
            background-color:#6680ff;
            color:#e4e7f7;
        }
    </style>
</head>
<body>
    <form method="post" action="http://localhost/hoanghuy/Deadline/taikhoan/suadl">
        <div class="phan">
            <div style="padding-bottom: 5px;"><h1 style=" font-size: 16px; margin: 0px;">Thông tin cá nhân</h1></div>
            <div><hr/></div>
            
            <div style="margin-top: 50px;">
                <input type="hidden" name="id" id="" value="<?php if(isset($user['username'])){echo $user['username']; }?>">
                <label for="">Giới Tính</label>
                <div>
                    <select class="btn" style="width: 52.3%;" name="gt" id="">
                        <option value="">---Chọn giới tính---</option>
                        <option value="Nam" <?php if(isset($user['sdt'])){if($user['gioitinh']=='Nam'){echo 'selected'; }}?>>Nam</option>
                        <option value="Nữ" <?php if(isset($user['sdt'])){if($user['gioitinh']=='Nữ'){echo 'selected'; }}?>>Nữ</option>
                    </select>
                </div>
                <label for="">Số Điện Thoại</label>
                <div>
                    <input required class="btn" type="text" name="sdt" id="" value="<?php if(isset($user['sdt'])){echo $user['sdt']; }?>">
                </div>
                <label for="">Email</label>
                <div>
                    <input required class="btn" type="email" name="email" id="" value="<?php if(isset($user['gmail'])){echo $user['gmail']; }?>">
                </div>
            </div>
            <div style="text-align: center;">
                <button type="submit" class="btnsua" name="btnLuu">Cập nhật</button>
            </div>
        </div>
    </form>
</body>
</html>
