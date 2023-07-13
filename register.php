<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/main.css">
    <title>Registration</title>
</head>
<body>
    <h1>Registration</h1>
    <?php
    error_reporting(0);
    if($_GET['getMsg'] == "alrEx"){
        $fm = "Username yang anda dimasukkan sudah tersedia dari basis data.";
        $fmSt = "color: red;";
    }
    ?>
    <h3 style="<?= $fmSt;?>">
    <?= $fm; ?>
    </h3>
    <form action="proc.php" method="post" enctype="multipart/form-data">
        <label for="fnamereg">Nama Lengkap</label>
        <input type="text" name="fnamereg" id="fnamereg" placeholder="Input the username...">
        <br>
        <label for="sxtypereg">Jenis Kelamin</label>
        <select name="sxtypereg" id="sxtypereg">
            <option value="Laki-Laki">Laki-Laki</option>
            <option value="Perempuan">Perempuan</option>
        </select>
        <br>
        <label for="userlvlreg">Jenis Kelamin</label>
        <select name="userlvlreg" id="usrlvlreg">
            <option value="1">Anggota</option>
            <option value="2">Admin</option>
            <option value="3">OP</option>
        </select>
        <br>
        <label for="rlgnreg">Agama</label>
        <select name="rlgnreg" id="rlgnreg">
            <option value="1">Kristen Katolik/Orthodox</option>
            <option value="2">Kristen Protestan</option>
            <option value="3">Islam</option>
            <option value="4">Hindu</option>
            <option value="5">Buddha</option>
            <option value="6">Kong Hu Cu</option>
        </select>
        <br>
        <label for="unamereg">Username</label>
        <input type="text" name="unamereg" id="unamereg" placeholder="Input the username...">
        <br>
        <label for="ymail">Email</label>
        <input type="email" name="ymail" placeholder="Input the email...">
        <br>
        <label for="homeaddrreg">Home Address</label>
        <input type="text" name="homeaddrreg" placeholder="Input the home address...">
        <br>
        <label for="phnumberreg">Phone Number</label>
        <input type="text" name="phnumberreg" placeholder="Input the phone number...">
        <br>
        <label for="pwrdreg">Kata Sandi</label>
        <input type="password" name="pwrdreg" placeholder="Input the password...">
        <br>
        <br>
        <label for="ft_prflreg"></label>
        <input type="file" name="ft_prflreg" id="ft_prflreg">
        <button type="submit" name="regProc">Sign Up</button>
        
    </form>
</body>
</html>