<?php
class taikhoan extends controller{
    private $datve;
    function __construct()
    {
        $this->datve=$this->model('Datve_m');
    }
    function Get_data(){
        $this->view('deadline',[
            'page'=>'taikhoan_v'
        ]);
    }
    function sua(){
        $this->view('deadline',[
            'page'=>'taikhoan_sua_v'
        ]);
    }
    function suadl(){
        if(isset($_POST['btnLuu'])){
            $thk=$_POST['id'];
            $ns=$_POST['gt'];
            $q=$_POST['sdt'];
            $dd=$_POST['email'];
            //gọi hàm sửa dl tacgia_upd trong model tacgia_m
            $kq=$this->datve->taikhoan_upd($thk,$ns,$q,$dd);
            if($kq)
                echo '<script>alert("Cập nhật thành công!")</script>';
            else
                echo '<script>alert("Cập nhật thất bại!")</script>';
           
            //gọi lại giao diện
            $this->view('deadline',[
                'page'=>'taikhoan_v',
            ]);
        }
    }
}
?>