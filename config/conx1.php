<?php
    
    class sqlCfg1{
        
        public function conxPrg($db_hname, $db_uname, $db_pwrd, $dbnm){
            global $conx1;
            $conx1 = mysqli_connect($db_hname, $db_uname, $db_pwrd, $dbnm);
        }
    }

    
    include 'dbcfg.php';
    $sqlCfg1 = new sqlCfg1();
    $sqlCfg1->conxPrg($db_hname1Here, $db_uname1Here, $db_pwrd1Here, $dbnm1Here);
    
    


?>