<?php   
    include '../config/conx.php';
    include '../config/conx1.php';
    session_start();
    if($_SESSION['logstatus'] != "logged_in"){
        header("location: ../index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Data</title>
    <link rel="stylesheet" href="../assets/main.css"></li>
</head>
<body>
    <h3>Welcome back, <?= $_SESSION['fname_sess'];?></h3>
    <br>
    <p>User Level : <?= $_SESSION['userlvl_sess'];?></p><br>
    <a href="lout.php">Click this to logout.</a>

    <table class="tabledesign1" id="adminTable">
        <thead>
            <tr>
                <th>NO</th>
                <th>Kode Peminjaman</th>
                <th>Nama Member</th>
                <th>Buku yang Dipinjam</th>
                <th>Tanggal Peminjaman</th>
                <th>Tanggal Harus Kembali</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $lsPinjamAdm = mysqli_query($conx1, "SELECT id_peminjaman, kd_peminjaman, nm_member, jdl_buku, tgl_pinjam, tgl_kembali
                FROM tb_peminjaman
                JOIN tb_member ON tb_member.id_member = tb_peminjaman.id_member
                JOIN tb_buku ON tb_buku.id_buku = tb_peminjaman.id_buku");
                $nb_pnjm = 1;
            ?>
            <?php while($fetchPinjamAdm = mysqli_fetch_assoc($lsPinjamAdm)):?>
            <tr>
                <td><?= $nb_pnjm;?></td>
                <td><?= $fetchPinjamAdm['kd_peminjaman']?></td>
                <td><?= $fetchPinjamAdm['nm_member']?></td>
                <td><?= $fetchPinjamAdm['jdl_buku']?></td>
                <td><?= $fetchPinjamAdm['tgl_pinjam']?></td>
                <td><?= $fetchPinjamAdm['tgl_kembali']?></td>
                <td>
                    <div class="act-button">
                    <a href="#" class="btn-upd">Perbarui</a> 
                    <a href="adm_qproc.php?getPnjmId=<?= $fetchPinjamAdm['id_peminjaman'];?>&getFlg=delPnjm" onclick='confirm("Anda yakin?")' class="btn-del">Hapus Data</a>
                    </div>
                </td>
            </tr>
            <?php $nb_pnjm++; endwhile;?>
        </tbody>
    </table>
    <script>
        function toggleAdminTableOn(){
            const admTbl = document.getElementById('adminTable');
            admTbl.style.display = 'table';
        }
        function toggleAdminTableOff(){
            const admTbl = document.getElementById('adminTable');
            admTbl.style.display = 'none';
        }
        <?php if($_SESSION['userlvl_sess'] == "Operator" OR $_SESSION['userlvl_sess'] == "Administrator") {
            echo "toggleAdminTableOn()";
        }
        elseif($_SESSION['userlvl_sess'] == "Ordinary Member"){
            echo "toggleAdminTableOff()";
        }
        ?>
        
    </script>
    
</body>
</html>