<?php
class Ve extends controller{
    function Get_data(){
        $this->view('deadline',[
            'page'=>'ve_v'
        ]);
    }
}
?>