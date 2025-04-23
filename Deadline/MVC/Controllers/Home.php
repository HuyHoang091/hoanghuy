<?php
class Home extends controller{
    function Get_data(){
        $this->view('deadline',[
            'page'=>'datngay'
        ]);
    }
}
?>