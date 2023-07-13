<?php   
    include '../config/conx.php';
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
                <th>Kode User</th>
                <th>Nama Lengkap</th>
                <th>Nama User</th>
                <th>Jenis Kelamin</th>
                <th>Agama</th>
                <th>Email</th>
                <th>Alamat</th>
                <th>Level User</th>
                <th>Foto Profil</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $lsUsrAdm = mysqli_query($conx, "SELECT id_user, usrc, nm_lengkap, nm_user, jk, agama, email, alamat, userlvl, ft_prfl
                FROM tb_user 
                JOIN tb_userlvl ON tb_user.id_userlvl = tb_userlvl.id_userlvl
                JOIN tb_agama ON tb_user.id_agama = tb_agama.id_agama");
                $nb_usr = 1;
            ?>
            <?php while($fetchUsrAdm = mysqli_fetch_assoc($lsUsrAdm)):?>
            <tr>
                <td><?= $nb_usr?></td>
                <td><?= $fetchUsrAdm['usrc']?></td>
                <td><?= $fetchUsrAdm['nm_lengkap']?></td>
                <td><?= $fetchUsrAdm['nm_user']?></td>
                <td><?= $fetchUsrAdm['jk']?></td>
                <td><?= $fetchUsrAdm['agama']?></td>
                <td><?= $fetchUsrAdm['email']?></td>
                <td><?= $fetchUsrAdm['alamat']?></td>
                <td><?= $fetchUsrAdm['userlvl']?></td>
                <td><img src="../profpic/<?= $fetchUsrAdm['ft_prfl']?>" width="30%"></td>
                <td>
                    <div class="act-button">
                    <a href="#" class="btn-upd">Perbarui</a> 
                    <a href="adm_qproc.php?getUsrId=<?= $fetchUsrAdm['id_user'];?>&getFlg=delUsr" onclick='confirm("Anda yakin?")' class="btn-del">Hapus Data</a>
                    </div>
                </td>
            </tr>
            <?php $nb_usr++; endwhile;?>
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