<?php
class Danhsachuser extends controller{
    private $datve;
    function __construct()
    {
        $this->datve=$this->model('Datve_m');
    }
    public function Get_data() {
        $this->view('deadline', [
            'page' => 'danhsachtaikhoan_v',
            'dulieu'=>$this->datve->user_find('','')
        ]);
    }
    function timkiem(){
        if(isset($_POST['btnTimkiem'])){
            $ddi=$_POST['txtDDi'];
            $dl=$this->datve->user_find($ddi,'');
            $this->view('deadline',[
                'page'=>'danhsachtaikhoan_v',
                'dulieu'=>$dl,
                'ddi'=>$ddi
            ]);
        }
    }
    public function them() {
        $this->view('deadline', [
            'page' => 'user_v'
        ]);
    }
    function luu(){
        if(isset($_POST['btnLuu'])){
            $thk=$_POST['THK'];
            $ns=$_POST['NS'];
            $q=$_POST['Q'];
            $dd=$_POST['DDI'];
            $de=$_POST['GT'];
            $gb=$_POST['GB'];
            $gd=$_POST['GD'];
            $pc=$_POST['pc'];
            //gọi hàm sửa dl tacgia_upd trong model tacgia_m
            $kq=$this->datve->user_ins($thk,$ns,$q,$dd,$de,$gb,$gd,$pc);
            if($kq)
                echo '<script>alert("Thêm thành công!")</script>';
            else
                echo '<script>alert("Thêm thất bại!")</script>';
           
            //gọi lại giao diện
            $this->view('deadline',[
                'page'=>'Danhsachtaikhoan_v',
                'dulieu'=>$this->datve->user_find('','')
            ]);
        }
    }
    function xoa($id){
        $kq=$this->datve->user_del($id);
        if($kq){
            echo '<script>alert("Xóa thành công!")</script>';
        }
        else{
            echo '<script>alert("Xóa thất bại!")</script>';
        }
        $this->view('deadline',[
            'page'=>'Danhsachtaikhoan_v',
            'dulieu'=>$this->datve->user_find('','')
        ]);
    }
    function sua($id){
        $this->view('deadline',[
            'page'=>'user_sua_v',
            'dulieu'=>$this->datve->user_find('',$id)
        ]); 
    }
    function suadl(){
        if(isset($_POST['btnLuu'])){
            $id=$_POST['ID'];
            $thk=$_POST['THK'];
            $ns=$_POST['NS'];
            $q=$_POST['Q'];
            $dd=$_POST['DDI'];
            $de=$_POST['GT'];
            $gb=$_POST['GB'];
            $gd=$_POST['GD'];
            $pc=$_POST['ND'];
            //gọi hàm sửa dl tacgia_upd trong model tacgia_m
            $kq=$this->datve->user_upd($id,$thk,$ns,$q,$dd,$de,$gb,$gd,$pc);
            if($kq)
                echo '<script>alert("Sửa thành công!")</script>';
            else
                echo '<script>alert("Sửa thất bại!")</script>';
           
            //gọi lại giao diện
            $this->view('deadline',[
                'page'=>'Danhsachtaikhoan_v',
                'dulieu'=>$this->datve->user_find('','')
            ]);
        }
    }
}
?>