<?php
class Datve extends controller{
    private $datve;
    function __construct()
    {
        $this->datve=$this->model('Datve_m');
    }
    function Get_data(){
        if(isset($_POST['timkiem'])){
            $kieuve=$_POST['option'];
            $date=$_POST['selectedDateHidden'];
            $date1=$_POST['selectedDateHidden1'];
            $tu=$_POST['passengers1'];
            $den=$_POST['passengers2'];
            $lon=$_POST['adults'];
            $tre=$_POST['children'];
            $be=$_POST['infant'];

            if($lon==0&&$tre==0&&$be==0){
                echo '<script> alert("Vui lòng chọn số lượng khách hàng!") </script>';
                $this->view('deadline',[
                    'page'=>'datngay'
                ]);
            }
            else if($date==''||$date1==''){
                echo '<script> alert("Không được để trống ngày đi/ngày về!") </script>';
                $this->view('deadline',[
                    'page'=>'datngay'
                ]);
            }
            else if($tu!=$den){
                $this->view('deadline',[
                    'page'=>'carcontainer',
                    'date'=>$date,
                    'date1'=>$date1,
                    'tu'=>$tu,
                    'den'=>$den,
                    'lon'=>$lon,
                    'tre'=>$tre,
                    'be'=>$be,
                    'kv'=>$kieuve
                ]);
            }
            else{
                echo '<script> alert("Điểm khởi hành và điểm đến không được trùng!") </script>';
                $this->view('deadline',[
                    'page'=>'datngay'
                ]);
            }
        }
    }
    // function timkiem(){
    //     $kieuve=$_POST['kv1'];
    //     $date=$_POST['selectedDateHidden'];
    //     $date1=$_POST['selectedDateHidden1'];
    //     $tu=$_POST['passengers1'];
    //     $den=$_POST['passengers2'];
    //     $lon=$_POST['adults'];
    //     $tre=$_POST['children'];
    //     $be=$_POST['infant'];
    //     $hangcb=$_POST['hangcb'];
    //     $gdut=$_POST['gdut'];
    //     $gvut=$_POST['gvut'];
    //     $hangbayloc=$_POST['hangbayloc'];
    //     $hangbayloc1=$_POST['hangbayloc1'];
    //     $this->view('deadline',[
    //         'page'=>'carcontainer',
    //         'date'=>$date,
    //         'date1'=>$date1,
    //         'tu'=>$tu,
    //         'den'=>$den,
    //         'lon'=>$lon,
    //         'tre'=>$tre,
    //         'be'=>$be,
    //         'kv'=>$kieuve,
    //         'hangcb'=>$hangcb,
    //         'gdut'=>$gdut,
    //         'gvut'=>$gvut,
    //         'hangbayloc'=>$hangbayloc,
    //         'hangbayloc1'=>$hangbayloc1
    //     ]);
    // }
    function Ve_may_bay(){
        $action = isset($_POST['action']) ? $_POST['action'] : 'default';
        if(isset($_POST['Timkiem'])){
            $kieuve=$_POST['kv1'];
            $date=$_POST['selectedDateHidden'];
            $date1=$_POST['selectedDateHidden1'];
            $tu=$_POST['passengers1'];
            $den=$_POST['passengers2'];
            $lon=$_POST['adults'];
            $tre=$_POST['children'];
            $be=$_POST['infant'];
            $hangcb=$_POST['hangcb'];
            $gdut=$_POST['gdut'];
            $gvut=$_POST['gvut'];
            $hangbayloc=$_POST['hangbayloc'];
            $hangbayloc1=$_POST['hangbayloc1'];
            $this->view('deadline',[
                'page'=>'carcontainer',
                'date'=>$date,
                'date1'=>$date1,
                'tu'=>$tu,
                'den'=>$den,
                'lon'=>$lon,
                'tre'=>$tre,
                'be'=>$be,
                'kv'=>$kieuve,
                'hangcb'=>$hangcb,
                'gdut'=>$gdut,
                'gvut'=>$gvut,
                'hangbayloc'=>$hangbayloc,
                'hangbayloc1'=>$hangbayloc1
            ]);
        }
        else if($action == 'kieuloc'){
            $kieuve=$_POST['kv1'];
            $date=$_POST['selectedDateHidden'];
            $date1=$_POST['selectedDateHidden1'];
            $tu=$_POST['passengers1'];
            $den=$_POST['passengers2'];
            $lon=$_POST['adults'];
            $tre=$_POST['children'];
            $be=$_POST['infant'];
            $hangcb=$_POST['hangcb'];
            $gdut=$_POST['gdut'];
            $gvut=$_POST['gvut'];
            $hangbayloc=$_POST['hangbayloc'];
            $hangbayloc1=$_POST['hangbayloc1'];
            $this->view('deadline',[
                'page'=>'carcontainer',
                'date'=>$date,
                'date1'=>$date1,
                'tu'=>$tu,
                'den'=>$den,
                'lon'=>$lon,
                'tre'=>$tre,
                'be'=>$be,
                'kv'=>$kieuve,
                'hangcb'=>$hangcb,
                'gdut'=>$gdut,
                'gvut'=>$gvut,
                'hangbayloc'=>$hangbayloc,
                'hangbayloc1'=>$hangbayloc1
            ]);
        }
        else{
            $date=$_POST['selectedDateHidden'];
            $date1=$_POST['selectedDateHidden1'];
            $tu=$_POST['passengers1'];
            $den=$_POST['passengers2'];
            $lon=$_POST['adults'];
            $tre=$_POST['children'];
            $be=$_POST['infant'];
            $gialon=$_POST['gialon'];
            $giatre=$_POST['giatre'];
            $giabe=$_POST['giabe'];
            $gialon1=$_POST['gialon1'];
            $giatre1=$_POST['giatre1'];
            $giabe1=$_POST['giabe1'];
            $giavedi=$_POST['giavedi'];
            $giaveve=$_POST['giaveve'];
            $giodi=$_POST['giodi'];
            $giove=$_POST['giove'];
            $giodi1=$_POST['giodi1'];
            $giove1=$_POST['giove1'];
            $kv=$_POST['kv'];
            $hmaybay=$_POST['hmaybay'];
            $hmaybay1=$_POST['hmaybay1'];
            $this->view('deadline', [
                'page'=>'dientt',
                'date'=>$date,
                'date1'=>$date1,
                'tu'=>$tu,
                'den'=>$den,
                'lon'=>$lon,
                'tre'=>$tre,
                'be'=>$be,
                'gialon'=>$gialon,
                'giatre'=>$giatre,
                'giabe'=>$giabe,
                'gialon1'=>$gialon1,
                'giatre1'=>$giatre1,
                'giabe1'=>$giabe1,
                'giavedi'=>$giavedi,
                'giaveve'=>$giaveve,
                'giodi'=>$giodi,
                'giove'=>$giove,
                'giodi1'=>$giodi1,
                'giove1'=>$giove1,
                'kv'=>$kv,
                'hmaybay'=>$hmaybay,
                'hmaybay1'=>$hmaybay1
            ]);
        }
    }
    function themve(){
        $diemdi=$_POST['diemdi'];
        $diemden=$_POST['diemden'];
        $giobay=$_POST['giobay'];
        $gioden=$_POST['gioden'];
        $ngaydi=$_POST['ngaydi'];
        $ngayve=$_POST['ngayve'];
        $giobay1=$_POST['giobay1'];
        $gioden1=$_POST['gioden1'];
        $lon=$_POST['lon'];
        $tre=$_POST['tre'];
        $be=$_POST['be'];
        $gioitinhlh=$_POST['gioitinhlh'];
        $txtTenlienhe=$_POST['txtTenlienhe'];
        $txtDtlienhe=$_POST['txtDtlienhe'];
        $klh=$_POST['a'];
        $elienhe=$_POST['elienhe'];
        $kv=$_POST['kv'];
        $user=$_POST['user'];
        $hmaybay=$_POST['hmaybay'];
        $hmaybay1=$_POST['hmaybay1'];
        $gialon=$_POST['gialon'];
        $giatre=$_POST['giatre'];
        $giabe=$_POST['giabe'];
        $gialon1=$_POST['gialon1'];
        $giatre1=$_POST['giatre1'];
        $giabe1=$_POST['giabe1'];
        $st=$_POST['sothenganhang'];
        $nganhang=$_POST['nganhang'];
        if($lon!=0){
            $gthkl = [];
            $thkl = [];
            $nshkl = [];
            for($i=1; $i<$lon+1;$i++){
                $key='gthkl'.$i;
                $key1='txtTenhkl'.$i;
                $key2='txtNshkl'.$i;
                if(isset($_POST[$key])){
                    $gthkl[$i]=$_POST[$key];
                    $thkl[$i]=$_POST[$key1];
                    $nshkl[$i]=$_POST[$key2];
                }
            }
        }
        if($tre!=0){
            $gthkt = [];
            $thkt = [];
            $nshkt = [];
            for($i=1; $i<$tre+1;$i++){
                $key3='gthkt'.$i;
                $key4='txtTenhkt'.$i;
                $key5='txtNshkt'.$i;
                if(isset($_POST[$key])){
                    $gthkt[$i]=$_POST[$key3];
                    $thkt[$i]=$_POST[$key4];
                    $nshkt[$i]=$_POST[$key5];
                }
            }
        }
        if($be!=0){
            $gthkb = [];
            $thkb = [];
            $nshkb = [];
            for($i=1; $i<$be+1;$i++){
                $key6='gthkb'.$i;
                $key7='txtTenhkb'.$i;
                $key8='txtNshkb'.$i;
                if(isset($_POST[$key])){
                    $gthkb[$i]=$_POST[$key6];
                    $thkb[$i]=$_POST[$key7];
                    $nshkb[$i]=$_POST[$key8];
                }
            }
        }
        $id = $this->datve->ttlh_ins($txtTenlienhe, $gioitinhlh, $txtDtlienhe, $klh, $elienhe, $user);
        if($id){
            // if($kv=="Một chiều"){
            //     $this->datve->ve_ins($id, $diemdi, $diemden, $giobay, $gioden, $ngaydi, $ngaydi);
            // }
            // else{
            //     $this->datve->ve_ins($id, $diemdi, $diemden, $giobay, $gioden, $ngaydi, $ngaydi);
            //     $this->datve->ve_ins($id, $diemden, $diemdi, $giobay1, $gioden1, $ngayve, $ngayve);
            // }
            if($lon!=0){
                if($kv=="Một chiều"){
                    for($i=1; $i<$lon+1; $i++){
                        $this->datve->tthk_ins($thkl[$i],$gthkl[$i],$nshkl[$i],$id,$diemdi, $diemden, $giobay, $gioden, $ngaydi, $hmaybay, $nganhang, $st, $gialon);
                    }
                }
                else{
                    for($i=1; $i<$lon+1; $i++){
                        $this->datve->tthk_ins($thkl[$i],$gthkl[$i],$nshkl[$i],$id,$diemdi, $diemden, $giobay, $gioden, $ngaydi, $hmaybay, $nganhang, $st, $gialon);
                        $this->datve->tthk_ins($thkl[$i],$gthkl[$i],$nshkl[$i],$id, $diemden, $diemdi, $giobay1, $gioden1, $ngayve, $hmaybay1, $nganhang, $st, $gialon1);
                    }
                }
            }
            if($tre!=0){
                if($kv=="Một chiều"){
                    for($i=1; $i<$tre+1; $i++){
                        $this->datve->tthk_ins($thkt[$i],$gthkt[$i],$nshkt[$i],$id,$diemdi, $diemden, $giobay, $gioden, $ngaydi, $hmaybay, $nganhang, $st, $giatre);
                    }
                }
                else{
                    for($i=1; $i<$tre+1; $i++){
                        $this->datve->tthk_ins($thkt[$i],$gthkt[$i],$nshkt[$i],$id,$diemdi, $diemden, $giobay, $gioden, $ngaydi, $hmaybay, $nganhang, $st, $giatre);
                        $this->datve->tthk_ins($thkt[$i],$gthkt[$i],$nshkt[$i],$id, $diemden, $diemdi, $giobay1, $gioden1, $ngayve, $hmaybay1, $nganhang, $st, $giatre1);
                    }
                }
            }
            if($be!=0){
                if($kv=="Một chiều"){
                    for($i=1; $i<$be+1; $i++){
                        $this->datve->tthk_ins($thkb[$i],$gthkb[$i],$nshkb[$i],$id,$diemdi, $diemden, $giobay, $gioden, $ngaydi, $hmaybay, $nganhang, $st, $giabe);
                    }
                }
                else{
                    for($i=1; $i<$be+1; $i++){
                        $this->datve->tthk_ins($thkb[$i],$gthkb[$i],$nshkb[$i],$id,$diemdi, $diemden, $giobay, $gioden, $ngaydi, $hmaybay, $nganhang, $st, $giabe);
                        $this->datve->tthk_ins($thkb[$i],$gthkb[$i],$nshkb[$i],$id, $diemden, $diemdi, $giobay1, $gioden1, $ngayve, $hmaybay1, $nganhang, $st, $giabe1);
                    }
                }
            }
            echo '<script>alert("Thanh toán thành công!"); window.location.href = "http://localhost/hoanghuy/Deadline/";</script>';
        }
        else{
            echo "Error inserting record.";
        }
    }
}
?>