<?php
class Danhsachgiave extends controller{
    private $datve;
    function __construct()
    {
        $this->datve=$this->model('Datve_m');
    }
    public function Get_data() {
        $this->view('deadline', [
            'page' => 'danhsachgiave_v',
            'dulieu'=>$this->datve->giave_find('','','')
        ]);
    }
    public function them() {
        $this->view('deadline', [
            'page' => 'Giave_v'
        ]);
    }
    function luu(){
        $ddi=$_POST['ddi'];
        $dde=$_POST['dde'];
        $hb=$_POST['hb'];
        $hang=$_POST['hang'];
        $gio=$_POST['gio'];
        $gia=$_POST['gia'];
        $kq=$this->datve->giave_ins($ddi,$dde,$hb,$hang,$gio,$gia);
        if($kq){
            echo '<script>alert("Thêm thành công!")</script>';
        }
        else{
            echo '<script>alert("Thêm thất bại!")</script>';
        }
        $this->view('deadline',[
            'page'=>'Danhsachgiave_v',
            'dulieu'=>$this->datve->giave_find('','','')
        ]);
    }
    function timkiem(){
        if(isset($_POST['btnTimkiem'])){
            $ddi=$_POST['txtDDi'];
            $dde=$_POST['txtDDen'];
            $dl=$this->datve->giave_find($ddi,$dde,'');
            $this->view('deadline',[
                'page'=>'danhsachgiave_v',
                'dulieu'=>$dl,
                'ddi'=>$ddi,
                'dde'=>$dde
            ]);
        }
    }
    function xoa($id){
        $kq=$this->datve->giave_del($id);
        if($kq){
            echo '<script>alert("Xóa thành công!")</script>';
        }
        else{
            echo '<script>alert("Xóa thất bại!")</script>';
        }
        $this->view('deadline',[
            'page'=>'Danhsachgiave_v',
            'dulieu'=>$this->datve->giave_find('','','')
        ]);
    }
    function sua($id){
        $this->view('deadline',[
            'page'=>'Giave_sua_v',
            'dulieu'=>$this->datve->giave_find('','',$id)
        ]); 
    }
    function suadl(){
        $id=$_POST['id'];
        $ddi=$_POST['ddi'];
        $dde=$_POST['dde'];
        $hb=$_POST['hb'];
        $hang=$_POST['hang'];
        $gio=$_POST['gio'];
        $gia=$_POST['gia'];
        $kq=$this->datve->giave_upd($id,$ddi,$dde,$hb,$hang,$gio,$gia);
        if($kq){
            echo '<script>alert("Sửa thành công!")</script>';
        }
        else{
            echo '<script>alert("Sửa thất bại!")</script>';
        }
        $this->view('deadline',[
            'page'=>'Danhsachgiave_v',
            'dulieu'=>$this->datve->giave_find('','','')
        ]);
    }
}
?>