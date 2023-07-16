<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Fa@Distro</title>
    <link rel="stylesheet" type="text/css" href="stlyle.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
</head>
<body id="bg-login">
    <div class="box-login">
        <h2>Login</h2>
        <form action="" method="post">
            <input type="text" name="user" placeholder="Username" class="input-control">
            <input type="password" name="pass" placeholder="Password" class="input-control">
            <input type="submit" name="submit" value="Login" class="btn">
        </form>
        <?php
            if(isset($_POST['submit'])){
                session_start();
                include "koneksi.php";
                $user = mysqli_real_escape_string($conn,$_POST['user']);
                $pass = mysqli_real_escape_string($conn,$_POST['pass']);

                $cek = mysqli_query($conn,"SELECT * FROM user WHERE username = '" .$user."' AND password = '".$pass."'");
                if(mysqli_num_rows($cek)>0){
                    $D = mysqli_fetch_object($cek);
                    $_SESSION['status_login'] = true;
                    $_SESSION['a_global'] = $D;
                    $_SESSION['id'] = $D->user_id;
                    echo '<script>window.location="dashboard.php"</script>';
                }else{
                    echo '<script>alert("Username atau password Anda Salah!")</script>';
                }
            }
        ?>
    </div>
</body>
</html>