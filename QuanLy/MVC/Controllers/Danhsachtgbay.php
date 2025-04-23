<?php
class Danhsachtgbay extends controller{
    private $datve;
    function __construct()
    {
        $this->datve=$this->model('Datve_m');
    }
    public function Get_data() {
        $this->view('deadline', [
            'page' => 'danhsachtgbay_v',
            'dulieu'=>$this->datve->tgbay_find('','','')
        ]);
    }
    public function them() {
        $this->view('deadline', [
            'page' => 'Tgb_v'
        ]);
    }
    function luu(){
        $ddi=$_POST['ddi'];
        $dde=$_POST['dde'];
        $gio=$_POST['gio'];
        $kq=$this->datve->tgbay_ins($ddi,$dde,$gio);
        if($kq){
            echo '<script>alert("Thêm thành công!")</script>';
        }
        else{
            echo '<script>alert("Thêm thất bại!")</script>';
        }
        $this->view('deadline',[
            'page'=>'Danhsachtgbay_v',
            'dulieu'=>$this->datve->tgbay_find('','','')
        ]);
    }
    function timkiem(){
        if(isset($_POST['btnTimkiem'])){
            $ddi=$_POST['txtDDi'];
            $dde=$_POST['txtDDen'];
            $dl=$this->datve->tgbay_find($ddi,$dde,'');
            $this->view('deadline',[
                'page'=>'danhsachtgbay_v',
                'dulieu'=>$dl,
                'ddi'=>$ddi,
                'dde'=>$dde
            ]);
        }
    }
    function xoa($id){
        $kq=$this->datve->tgbay_del($id);
        if($kq){
            echo '<script>alert("Xóa thành công!")</script>';
        }
        else{
            echo '<script>alert("Xóa thất bại!")</script>';
        }
        $this->view('deadline',[
            'page'=>'Danhsachtgbay_v',
            'dulieu'=>$this->datve->tgbay_find('','','')
        ]);
    }
    function sua($id){
        $this->view('deadline',[
            'page'=>'Tgb_sua_v',
            'dulieu'=>$this->datve->tgbay_find('','',$id)
        ]); 
    }
    function suadl(){
        $id=$_POST['id'];
        $ddi=$_POST['ddi'];
        $dde=$_POST['dde'];
        $gio=$_POST['gio'];
        $kq=$this->datve->tgbay_upd($id,$ddi,$dde,$gio);
        if($kq){
            echo '<script>alert("Sửa thành công!")</script>';
        }
        else{
            echo '<script>alert("Sửa thất bại!")</script>';
        }
        $this->view('deadline',[
            'page'=>'Danhsachtgbay_v',
            'dulieu'=>$this->datve->tgbay_find('','','')
        ]);
    }
}
?>