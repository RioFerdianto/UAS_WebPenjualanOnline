<?php
    session_start();
    include 'koneksi.php';
    if($_SESSION['status_login'] != true){
        echo '<script>window.location="login.php"</script>';
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barang | Fa@Distro</title>
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
            <h3>Tambahkan Data Barang</h3>
            <div class="box">
                <form action="" method="post" enctype="multipart/form-data">
                    <select class="input-control" name="kategori" required>
                        <option value="">--PILIH--</option>
                        <?php
                            $kategori = mysqli_query($conn, "SELECT * FROM kategori ORDER BY kategori_id DESC");
                            while($r = mysqli_fetch_array($kategori)){
                        ?>
                        <option value="<?php echo $r['kategori_id'] ?>"><?php echo $r['nm_kategori']?></option>
                        <?php } ?>
                    </select>
                    <input type="text" name="nama" class="input-control" placeholder="Nama Barang" required>
                    <textarea type="text" name="spesifikasi" class="input-control" placeholder="Spesifikasi"></textarea>
                    <input type="text" name="harga" class="input-control" placeholder="Harga" required>
                    <input type="text" name="stok" class="input-control" placeholder="Stok" required>
                    <input type="file" name="gambar" class="input-control" required>
                    <select class="input-control" name="status">
                        <option value="">--Pilih--</option>
                        <option value="1">Ready</option>
                        <option value="0">Tidak Ready</option>
                    </select>
                    <input type="submit" name="submit" value="Tambahkan" class="btn">
                </form>
                <?php
                if(isset($_POST['submit'])){
                    // print_r($_FILES['gambar']);
                    // menampung inputan dari form
                    $kategori       = $_POST['kategori'];
                    $nama           = $_POST['nama'];
                    $spesifikasi    = $_POST['spesifikasi'];
                    $harga          = $_POST['harga'];
                    $stok           = $_POST['stok'];
                    $status         = $_POST['status'];

                    // menampung data file yg diuplod
                    $filename = $_FILES['gambar']['name'];
                    $tmp_name = $_FILES['gambar']['tmp_name'];

                    $type1    = explode('.',$filename);
                    $type2    = $type1[1];

                    $newname    = 'produk'.time().'.'.$type2;
                    // menampung data format file yang diizinkan
                    $tipe_diizinkan = array('jpeg', 'jpg', 'png', 'gif');
                    // validasi format file
                    if(!in_array($type2, $tipe_diizinkan)){
                        //proses format jika tidak dizinkan
                        echo '<script>alert("Format file tidak dizinkan")</script>';
                    }else{
                        //jika format telah dizinkan
                        move_uploaded_file($tmp_name, './produk/'.$newname);
                        $insert = mysqli_query($conn, "INSERT INTO barang VALUES (
                            null, 
                        '".$kategori."',
                        '".$nama."',
                        '".$spesifikasi."',
                        '".$harga."',
                        '".$stok."',
                        '".$newname."',
                        '".$status."' )");
                        if($insert){
                            echo '<script>("Ubah Data Berhasil")</script>';
                            echo '<script>window.location = "barang.php"</script>';
                        }else{
                            echo 'gagal'.mysqli_error($conn);
                        }
                    }
                    // proses upload file & insert ke database
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