<?php
    
    class sqlCfg{
        
        public function conxPrg($db_hname, $db_uname, $db_pwrd, $dbnm){
            global $conx;
            $conx = mysqli_connect($db_hname, $db_uname, $db_pwrd, $dbnm);
        }
    }

    
    include 'dbcfg.php';
    $sqlCfg = new sqlCfg();
    $sqlCfg->conxPrg($db_hnameHere, $db_unameHere, $db_pwrdHere, $dbnmHere);
    
    


?>