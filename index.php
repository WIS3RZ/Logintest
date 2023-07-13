<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/main.css">
    <title>Test Login</title>
</head>
<body>
    <?php
    error_reporting(0);
    $flsMsg = array(
     "Username/Pass salah!", 
     "Username/Pass wajib diisi!", 
     "Anda telah berhasil keluar dari akun."
    );
    if($_GET['getMsg'] == "wpass"){
        $fm = $flsMsg[0];
        $fmSt = "color: red;";
    }
    elseif($_GET['getMsg'] == "ismdtr"){
        $fm = $flsMsg[1];
    }
    elseif($_GET['getMsg'] == "lgOut"){
        $fm = $flsMsg[2];
        $fmSt = "color: green;";
    }
    ?>
    <br>
    <h3 style="<?= $fmSt; ?>"> <?= $fm; ?></h3>
    <form action="proc.php" method="post">
        <label for="unamelog">Username</label>
        <input type="text" name="unamelog" id="unamelog">
        <br>
        <br>
        <label for="pwrd">Password</label>
        <input type="password" name="pwrdlog" id="pwrdlog">
        <br>
        <br>
        <button type="submit" name="login">Login</button>
    </form>
    
</body>
</html>