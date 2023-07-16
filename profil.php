<?php
    session_start();
    include 'koneksi.php';
    if($_SESSION['status_login'] != true){
        echo '<script>window.location="login.php"</script>';
    }

    $query = mysqli_query($conn, "SELECT * FROM user WHERE user_id = '".$_SESSION['id']."'");
    $D = mysqli_fetch_object($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil | Fa@Distro</title>
    <link rel="stylesheet" type="text/css" href="stlyle.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
</head>
<body>
    <!--header-->
    <header>
        <div class="container">
            <h1><a href="dashboard.php">Rio Ferdianto</a></h1>
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="profil.php">Profil</a></li>
                <li><a href="kategori.php">Data Kategori</a></li>
                <li><a href="barang.php">Data Barang</a></li>
                <li><a href="keluar.php">Keluar</a></li>
            </ul>
        </div>
    </header>
    <!-- isi conten-->
    <div class="section">
        <div class="container">
            <h3>Profil Anda</h3>
            <div class="box">
                <form action="" method="post">
                    <input type="text" name="nama" placeholder="Nama Lengkap" class="input-control" value="<?php echo $D->nama ?>" required>
                    <input type="text" name="user" placeholder="Username" class="input-control" value="<?php echo $D->username ?>" required>
                    <input type="text" name="hp" placeholder="No Phone" class="input-control" value="<?php echo $D->phone ?>" required>
                    <input type="text" name="email" placeholder="Email" class="input-control" value="<?php echo $D->email ?>" required>
                    <input type="text" name="alamat" placeholder="Alamat" class="input-control" value="<?php echo $D->alamat ?>" required>
                    <input type="submit" name="submit" value="Ubah Profil" class="btn">
                </form>
                <?php
                    if(isset($_POST['submit'])){
                        
                        $nama       = ucwords($_POST['nama']);
                        $user       = $_POST['user'];
                        $phone      = $_POST['hp'];
                        $email      = $_POST['email'];
                        $alamat     = ucwords($_POST['alamat']);

                        $update = mysqli_query($conn, "UPDATE user SET
                                nama        = '".$nama."',
                                username    = '".$user."',
                                phone       = '".$phone."',
                                email       = '".$email."',
                                alamat      = '".$alamat."'
                                WHERE user_id = '".$D->user_id."' ");
                        if($update){
                            echo '<script>alert("Data Berhasil diUbah")</script>';
                            echo '<script>window.location="profil.php"</script>';
                        }else{
                            echo 'gagal'.mysqli_error($conn);
                        }
                    }
                ?>
            </div>
            <h3>Password</h3>
            <div class="box">
                <form action="" method="post">
                    <input type="password" name="pass1" placeholder="Password Baru" class="input-control" required>
                    <input type="password" name="pass2" placeholder="Konfirmasi Password Baru" class="input-control" required>
                    <input type="submit" name="ubah_password" value="Ubah Password" class="btn">
                </form>
                 <?php
                    if(isset($_POST['ubah_password'])){
                        
                        $pass1       = $_POST['pass1'];
                        $pass2      = $_POST['pass2'];

                        if($pass2 != $pass1){
                            echo '<script>alert("Konfirmasi Password Baru tidak sesuai"></script>';
                        }else{

                            $u_pass = mysqli_query($conn, "UPDATE user SET password = '".$pass1."' WHERE user_id = '".$D->user_id."' ");
                            if($u_pass){
                                echo '<script>alert("Data Berhasil diUbah")</script>';
                                echo '<script>window.location="profil.php"</script>';
                            }else{
                                echo 'gagal'.mysqli_error($conn);
                            }
                        }
                    }
                ?>
            </div> 
        </div>
    </div>   
    <!--footer-->
    <div class="container">
        <small>Copyright &copy;2023 - RioFerdianto</small>
    </div>
</body>
</html>