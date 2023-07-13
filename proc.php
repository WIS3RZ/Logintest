<?php



include "config/conx.php";


$msgList = array("wpass", "usrexist", "ismdtr");


if(isset($_POST['regProc']))
{
    $regFName = $_POST['fnamereg'];
    $regUName = strtolower($_POST['unamereg']);
    $jkReg = $_POST['sxtypereg'];
    $regRlgn = $_POST['rlgnreg'];
    $regMail = $_POST['ymail'];
    $regPwrd = password_hash($_POST['pwrdreg'], PASSWORD_ARGON2I);
    $regAddr = $_POST['homeaddrreg'];
    $regPhNum = $_POST['phnumberreg'];
    $regUsrLvl = $_POST['userlvlreg'];

   

    $usrAlEx = $conx->prepare("SELECT nm_lengkap, nm_user, agama, email, pwrd, userlvl FROM tb_user JOIN tb_userlvl ON tb_user.id_userlvl = tb_userlvl.id_userlvl JOIN tb_agama ON tb_user.id_agama = tb_agama.id_agama WHERE nm_lengkap = ? AND nm_user = ?");
    $usrAlEx->bind_param('ss', $regFName, $regUName);
    $usrAlEx->execute();
    $usrAlEx->store_result();
    $usrAlEx->bind_result($regFnmStore, $regUnmStore, $regRlgnStore, $regMailStore, $regPwrdStore, $regUsrLvlStore);
    $usrAlEx->fetch();

    # CEK KETERSEDIAAN USERNAME DAN NAMA LENGKAP #
    if($regFnmStore == $regFName && $regUnmStore == $regUName){
        header("location: register.php?getMsg=alrEx");  
    }

    else{
        # UPLOAD GAMBAR #
        $alwdExt = array('png', 'jpg', 'jpeg');

        $flNm = $_FILES['ft_prflreg']['name'];
        $x = explode('.', $flNm);
        $flNmExt = strtolower(end($x));
        $flSz = $_FILES['ft_prflreg']['size'];
        $flNmTmp = $_FILES['ft_prflreg']['tmp_name'];

        if(in_array($flNmExt, $alwdExt) == true)
        {
            # CEK UKURAN FILE#
            if($prflreg_flSz < 400000){
                move_uploaded_file($flNmTmp, 'profpic/'.$flNm);

                $rgProc = mysqli_query($conx, "INSERT INTO tb_user(nm_lengkap, nm_user, jk, id_agama, email, pwrd, alamat, telp, id_userlvl, ft_prfl) VALUES ('".$regFName."','".$regUName."','".$jkReg."', '".$regRlgn."', '".$regMail."', '".$regPwrd."', '".$regAddr."','".$regPhNum."','".$regUsrLvl."','".$flNm."')");
                
                if($rgProc){
                    header("location: index.php");
                    $rgProc->close();
                    $conx->close();
                }
            }
            else{
                header("location: register.php");
            }
        }
        else{
            header("location: register.php");
        }
    }
}
elseif(isset($_POST['login'])){
    # POST dari FORM ke PROSES
    $logUNamePst = trim($_POST['unamelog']);
    $logPwrdPst = $_POST['pwrdlog'];
    if(!empty($logUNamePst) && !empty($logPwrdPst))
    {
        
        /** 
        * 'real_escape_string' secara harfiah berarti 'benang kalimat pelarian nyata'
        * artinya nama pengguna yang anda masukkan akan terhindar dari SQL Injection yang berisiko membahayakan.
        */
        $logUName = $conx->real_escape_string($logUNamePst);
        $logPwrd = $logPwrdPst;
        $logPwrdHsh = password_hash($logPwrd, PASSWORD_ARGON2I);
        
        # PILIH DATA BERDASARKAN USERNAME DAN PASSWORD MASUK #
        $loginQuery = mysqli_query($conx,"SELECT nm_lengkap, nm_user, agama, pwrd, userlvl, ft_prfl FROM tb_user JOIN tb_userlvl ON tb_user.id_userlvl = tb_userlvl.id_userlvl JOIN tb_agama ON tb_user.id_agama = tb_agama.id_agama WHERE nm_user = '".$logUName."'");
        # DAPATKAN HASIL QUERY #
        $logChk = mysqli_num_rows($loginQuery);
        
        if($logChk === 1){
            $lInRow = mysqli_fetch_array($loginQuery);
            if (password_verify($logPwrd, $lInRow['pwrd'])){
                session_start();
                $_SESSION['logstatus'] = "logged_in";
                $_SESSION['fname_sess'] = $lInRow['nm_lengkap'];
                $_SESSION['userlvl_sess'] = $lInRow['userlvl'];
                $_SESSION['ftprfl_sess'] = $lInRow['ft_prfl'];
                header("location: logsess/index.php");
            }
            else{
                
                session_destroy();
                header("location: index.php?getMsg=$msgList[0]");
            }
        }
        
    }
    else
    {
       header("location: index.php?getMsg=$msgList[2]");
    }
    
    
    
}
else{
    echo "Flag not found!";
}
    

    


?>