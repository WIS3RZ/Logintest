<?php
    include "../config/conx.php";
    include "../config/conx1.php";

    $rtrNmPnjm = mysqli_query($conx1, "SELECT * from tb_member");
    $rtrJdlBukuPnjm = mysqli_query($conx1, "SELECT * from tb_buku");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pinjam</title>
    <link rel="stylesheet" href="../assets/main.css">
</head>
<body>
    <form action="adm_qproc.php" method="post">
        <label for="nm_peminjam">Nama Peminjam</label>
        <select name="nm_peminjam" id="nm_peminjam">
        <?php while($fetchNmPnjm = mysqli_fetch_assoc($rtrNmPnjm)):?>
            <option value="<?= $fetchNmPnjm['id_member']?>"><?= $fetchNmPnjm['nm_member']?></option>
            <?php endwhile; ?>
        </select>
        <br>
        <label for="nm_bukupnjm">Buku Yang Dipinjam</label>
        <select name="nm_bukupnjm" id="nm_bukupnjm">
        <?php while($fetchBukuPnjm = mysqli_fetch_assoc($rtrJdlBukuPnjm)):?>
            <option value="<?= $fetchBukuPnjm['id_buku']?>"><?= $fetchBukuPnjm['jdl_buku']?></option>
            <?php endwhile; ?>
        </select>
        <br>
        <label for="tglPinjamPst">Tanggal Pinjam</label>
        <input type="datetime-local" name="tglPinjamPst">
        <input type="hidden" name="postFlg" id="postFlg" value="insPnjm">
        <button type="submit">Submit</button>
        
    </form>
</body>
</html>