<?php 
    class Datve_m extends connectDB{

        // Thông tin liên hệ---------------------------------------------------------------------------------------------------------

        public function ttlh_ins($tlh, $gt, $sdt, $klh, $email, $user) {
            $sql = "INSERT INTO thongtinlienhe (TenLienHe,GioiTinh,SoDienThoai,KenhLienHe,Email,TaiKhoan)
            VALUES ('$tlh', '$gt', '$sdt', '$klh', '$email', '$user')";
            if (mysqli_query($this->con, $sql)) {
                return mysqli_insert_id($this->con);
            } else {
                return false;
            }
        }
        function ttlh_find($tlh, $id){
            $sql="SELECT * FROM thongtinlienhe WHERE TenLienHe like '%$tlh%' AND ID like '%$id%'";
            return mysqli_query($this->con,$sql);
        }
        function ttlh_del($id){
            $sql="DELETE FROM thongtinlienhe WHERE ID='$id'";
            return mysqli_query($this->con,$sql);
        }
        function ttlh_deltthk($id){
            $sql="DELETE FROM thongtinhanhkhach WHERE IDLienHe='$id'";
            return mysqli_query($this->con,$sql);
        }
        function ttlh_upd($id,$tlh,$qd,$dt,$klh,$e,$tk){
            $sql="UPDATE thongtinlienhe SET TenLienHe='$tlh', GioiTinh='$qd', SoDienThoai='$dt', KenhLienHe='$klh', Email='$e', TaiKhoan='$tk'
            WHERE ID='$id'";
            return mysqli_query($this->con,$sql);
        }

        // Thông tin hành khách------------------------------------------------------------------------------------------------------

        function tthk_ins($tkh,$gt,$ns,$lh, $ddi,$dden,$gb,$gv,$nd,$hb,$nh,$st,$stien){
            $sql="INSERT INTO thongtinhanhkhach (TenHanhKhach,GioiTinh,NgaySinh,IDLienHe,DiemDi,DiemDen,GioBay,GioDen,NgayDi,HangBay,NganHang,SoThe,SoTien,TrangThai)
            VALUES('$tkh','$gt','$ns', '$lh','$ddi','$dden','$gb','$gv','$nd','$hb','$nh','$st','$stien','Chưa sử dụng')";
            return mysqli_query($this->con,$sql);
        }
        function tthk_del($id){
            $sql="DELETE FROM thongtinhanhkhach WHERE ID='$id'";
            return mysqli_query($this->con,$sql);
        }
        function tthk_upd($id, $tkh,$gt,$ns,$lh, $ddi,$dden,$gb,$gv,$nd,$hb,$tt){
            $sql="UPDATE thongtinhanhkhach SET TenHanhKhach='$tkh', GioiTinh='$gt', NgaySinh='$ns', IDLienHe='$lh', DiemDi='$ddi', DiemDen='$dden', GioBay='$gb', GioDen='$gv', NgayDi='$nd', HangBay='$hb', TrangThai='$tt'
            WHERE ID='$id'";
            return mysqli_query($this->con,$sql);
        }
        function tthk_updss($lh, $ddi,$dden,$gb,$gv,$nd,$hb,$tt){
            $sql="UPDATE thongtinhanhkhach SET HangBay='$hb', TrangThai='$tt'
            WHERE IDLienHe='$lh' AND DiemDi='$ddi' AND DiemDen='$dden' AND GioBay='$gb' AND GioDen='$gv' AND NgayDi='$nd'";
            return mysqli_query($this->con,$sql);
        }
        function tthk_find($id){
            $sql="SELECT * FROM thongtinhanhkhach WHERE ID like '%$id%'";
            return mysqli_query($this->con,$sql);
        }

        // Giá vé----------------------------------------------------------------------------------------------------

        function giave_ins($tkh,$gt,$ns,$lh, $ddi,$dden){
            $sql="INSERT INTO giave (DiemDi,DiemDen,HangBay,Hang,GioDi,Gia)
            VALUES('$tkh','$gt','$ns', '$lh','$ddi','$dden')";
            return mysqli_query($this->con,$sql);
        }
        function giave_find($ddi, $dde, $id){
            $sql="SELECT * FROM giave WHERE DiemDi like '%$ddi%' AND DiemDen like '%$dde%' AND ID like '%$id%'";
            return mysqli_query($this->con,$sql);
        }
        function giave_del($id){
            $sql="DELETE FROM giave WHERE ID='$id'";
            return mysqli_query($this->con,$sql);
        }
        function giave_upd($id, $tkh,$gt,$ns,$lh, $ddi,$dden){
            $sql="UPDATE giave SET DiemDi='$tkh', DiemDen='$gt', HangBay='$ns', Hang='$lh', GioDi='$ddi', Gia='$dden'
            WHERE ID='$id'";
            return mysqli_query($this->con,$sql);
        }

        // Thời gian bay---------------------------------------------------------------------------------------------

        function tgbay_ins($tkh,$gt,$ns){
            $sql="INSERT INTO thoigianbay (DiemDi,DiemDen,ThoiGianBay)
            VALUES('$tkh','$gt','$ns')";
            return mysqli_query($this->con,$sql);
        }
        function tgbay_find($ddi, $dde, $id){
            $sql="SELECT * FROM thoigianbay WHERE DiemDi like '%$ddi%' AND DiemDen like '%$dde%' AND ID like '%$id%'";
            return mysqli_query($this->con,$sql);
        }
        function tgbay_del($id){
            $sql="DELETE FROM thoigianbay WHERE ID='$id'";
            return mysqli_query($this->con,$sql);
        }
        function tgbay_upd($id, $tkh,$gt,$ns){
            $sql="UPDATE thoigianbay SET DiemDi='$tkh', DiemDen='$gt', ThoiGianBay='$ns'
            WHERE ID='$id'";
            return mysqli_query($this->con,$sql);
        }

        // User--------------------------------------------------------------------------------------------------

        function user_ins($tkh,$gt,$ns,$lh, $ddi,$dden,$gb,$gv){
            $sql="INSERT INTO account (display_Account,password_Account,type_Account,username_Account,gender_Account,phone_Account,	gmail_Account,picture_Account)
            VALUES('$tkh','$gt','$ns', '$lh','$ddi','$dden','$gb','$gv')";
            return mysqli_query($this->con,$sql);
        }
        function user_find($acc, $id){
            $sql="SELECT * FROM account WHERE display_Account like '%$acc%' AND id like '%$id%'";
            return mysqli_query($this->con,$sql);
        }
        function user_del($id){
            $sql="DELETE FROM account WHERE id='$id'";
            return mysqli_query($this->con,$sql);
        }
        function user_upd($id, $tkh,$gt,$ns,$lh, $ddi,$dden,$gb,$gv){
            $sql="UPDATE account SET display_Account='$tkh', password_Account='$gt', type_Account='$ns', username_Account='$lh', gender_Account='$ddi', phone_Account='$dden', gmail_Account='$gb', picture_Account='$gv'
            WHERE id='$id'";
            return mysqli_query($this->con,$sql);
        }
        function taikhoan_upd($id,$ddi,$dden,$gb){
            $sql="UPDATE account SET gender_Account='$ddi', phone_Account='$dden', gmail_Account='$gb'
            WHERE username_Account='$id'";
            return mysqli_query($this->con,$sql);
        }
    }
?>        