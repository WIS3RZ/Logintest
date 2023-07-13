<?php
    include "../config/conx.php";
    include "../config/conx1.php";
    $flgPost = $_POST['postFlg'];
    $flgGet = $_GET["getFlg"];
    
    

    if($flgGet == "delUsr"){
        $idUsrGet = $_GET['getUsrId']; 
        $delUsrAdm = mysqli_query($conx, "DELETE FROM tb_user where id_user = '$idUsrGet'");
        header("location: index.php");
    }
    elseif($flgGet == "delPnjm"){
        $idPnjmGet = $_GET['getPnjmId'];
        $delPnjmAdm = mysqli_query($conx1, "DELETE FROM tb_peminjaman where id_peminjaman = '$idPnjmGet'");
        if($delPnjmAdm == TRUE){
            header("location: master_pinjam.php");
        }       
    }
    elseif($flgPost == "insPnjm"){
        $postNmPnjm = $_POST['nm_peminjam'];
        $postNmBukuPnjm = $_POST['nm_bukupnjm'];
        $postTglPnjm = $_POST['tglPinjamPst'];
        $postTglPnjmStrInit = new DateTime($postTglPnjm);
        $postTglPnjmStrFinal = $postTglPnjmStrInit->format('Y-m-d H:i:s');
        $postTglKembali = new DateTime($postTglPnjm);
        $postTglKembali->add(new DateInterval('P1D'));
        $cnvTglKembaliToStr = $postTglKembali->format('Y-m-d H:i:s');

        $addPnjmAdm = mysqli_query($conx1,"INSERT INTO tb_peminjaman (id_member, id_buku, tgl_pinjam, tgl_kembali) values ('$postNmPnjm', '$postNmBukuPnjm', '".$postTglPnjmStrFinal."', '".$cnvTglKembaliToStr."')");
        if($addPnjmAdm === TRUE){
            header("location: master_pinjam.php");
        }
    }
?>