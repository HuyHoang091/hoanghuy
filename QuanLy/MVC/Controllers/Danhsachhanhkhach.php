<?php
class Danhsachhanhkhach extends controller{
    private $datve;
    function __construct()
    {
        $this->datve=$this->model('Datve_m');
    }
    public function Get_data() {
        $this->view('deadline', [
            'page' => 'danhsachhanhkhach_v',
            'dulieu'=>$this->datve->ttlh_find('','')
        ]);
    }
    function timkiem(){
        if(isset($_POST['btnTimkiem'])){
            $tlh=$_POST['txtTenLienHe'];
            $dl=$this->datve->ttlh_find($tlh,'');
            $this->view('deadline',[
                'page'=>'danhsachhanhkhach_v',
                'dulieu'=>$dl,
                'tlh'=>$tlh
            ]);
        }
    }
    function xoattlh($id){
        $kq=$this->datve->ttlh_del($id);
        if($kq){
            $this->datve->ttlh_deltthk($id);
            echo '<script>alert("Xóa thành công!")</script>';
        }
        else{
            echo '<script>alert("Xóa thất bại!")</script>';
        }
        $this->view('deadline',[
            'page'=>'Danhsachhanhkhach_v',
            'dulieu'=>$this->datve->ttlh_find('','')
        ]);
    }
    function suattlh($id){
        $this->view('deadline',[
            'page'=>'Ttlh_sua_v',
            'dulieu'=>$this->datve->ttlh_find('',$id)
        ]); 
    }
    function suadlttlh(){
        if(isset($_POST['btnLuu'])){
            $id=$_POST['ID'];
            $tlh=$_POST['TLH'];
            $qd=$_POST['QD'];
            $sdt=$_POST['DT'];
            $klh=$_POST['KLH'];
            $email=$_POST['Email'];
            $tk=$_POST['TK'];
            //gọi hàm sửa dl tacgia_upd trong model tacgia_m
            $kq=$this->datve->ttlh_upd($id,$tlh,$qd,$sdt,$klh,$email,$tk);
            if($kq)
                echo '<script>alert("Sửa thành công!")</script>';
            else
                echo '<script>alert("Sửa thất bại!")</script>';
           
            //gọi lại giao diện
            $this->view('deadline',[
                'page'=>'Danhsachhanhkhach_v',
                'dulieu'=>$this->datve->ttlh_find('','')
            ]);
        }
    }
    function xoatthk($id){
        $kq=$this->datve->tthk_del($id);
        if($kq){
            echo '<script>alert("Xóa thành công!")</script>';
        }
        else{
            echo '<script>alert("Xóa thất bại!")</script>';
        }
        $this->view('deadline',[
            'page'=>'Danhsachhanhkhach_v',
            'dulieu'=>$this->datve->ttlh_find('','')
        ]);
    }
    function suatthk($id){
        $this->view('deadline',[
            'page'=>'Tthk_sua_v',
            'dulieu'=>$this->datve->tthk_find($id)
        ]); 
    }
    function suadltthk(){
        if(isset($_POST['btnLuu'])){
            $id=$_POST['ID'];
            $thk=$_POST['THK'];
            $gt=$_POST['GT'];
            $ns=$_POST['NS'];
            $idlh=$_POST['IDLH'];
            $dd=$_POST['DDI'];
            $de=$_POST['DDEN'];
            $gb=$_POST['GB'];
            $gd=$_POST['GD'];
            $nd=$_POST['ND'];
            $hb=$_POST['HB'];
            $tt=$_POST['TrangThai'];
            //gọi hàm sửa dl tacgia_upd trong model tacgia_m
            $kq=$this->datve->tthk_upd($id,$thk,$gt,$ns,$idlh,$dd,$de,$gb,$gd,$nd,$hb,$tt);
            if($kq){
                $this->datve->tthk_updss($idlh,$dd,$de,$gb,$gd,$nd,$hb,$tt);
                echo '<script>alert("Sửa thành công!")</script>';
            }
            else{
                echo '<script>alert("Sửa thất bại!")</script>';
            }
           
            //gọi lại giao diện
            $this->view('deadline',[
                'page'=>'Danhsachhanhkhach_v',
                'dulieu'=>$this->datve->ttlh_find('','')
            ]);
        }
    }
}
?>