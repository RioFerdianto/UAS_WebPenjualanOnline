<?php
    session_start();
    include 'koneksi.php';
    if($_SESSION['status_login'] != true){
        echo '<script>window.location="login.php"</script>';
    }
    $barang =  mysqli_query($conn, "SELECT * FROM barang WHERE barang_id = '".$_GET['id']."' ");
    if(mysqli_fetch_row($barang)== 0){
        echo '<script>window.location = "barang.php"</script>';
    }
    $p = mysqli_fetch_object($barang);
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
            <h3>Edit Data Barang</h3>
            <div class="box">
                <form action="" method="post" enctype="multipart/form-data">
                    <select class="input-control" name="kategori" required>
                        <option value="">--PILIH--</option>
                        <?php
                            $kategori = mysqli_query($conn, "SELECT * FROM kategori ORDER BY kategori_id DESC");
                            while($r = mysqli_fetch_array($kategori)){
                        ?>
                        <option value="<?php echo $r['kategori_id'] ?>" <?php echo($r['kategori_id'] == $p->kategori_id)? 'selected':'';?>><?php echo $r['nm_kategori']?></option>
                        <?php } ?>
                    </select>
                    <input type="text" name="nama" class="input-control" placeholder="Nama Barang" value="<?php echo $p->nm_barang ?>">
                    <textarea type="text" name="spesifikasi" class="input-control" placeholder="Spesifikasi"><?php echo $p->spesifikasi ?></textarea>
                    <input type="text" name="harga" class="input-control" placeholder="Harga" value="<?php echo $p->harga ?>">
                    <input type="text" name="stok" class="input-control" placeholder="Stok" value="<?php echo $p->stok ?>">
                    <img src="produk/<?php echo $p->gmr_barang ?>" width="300px">
                    <input type="hidden" name="foto" value="<?php echo $p->gmr_barang ?>">
                    <input type="file" name="gambar" class="input-control">
                    <select class="input-control" name="status">
                        <option value="">--Pilih--</option>
                        <option value="1" <?php echo($p->status == 1)? 'selected':'';?>>Ready</option>
                        <option value="0" <?php echo($p->status == 0)? 'selected':'';?>>Tidak Ready</option>
                    </select>
                    <input type="submit" name="submit" value="Tambahkan" class="btn">
                </form>
                <?php
                if(isset($_POST['submit'])){
                   // data inputan dari form
                   $kategori       = $_POST['kategori'];
                   $nama           = $_POST['nama'];
                   $spesifikasi    = $_POST['spesifikasi'];
                   $harga          = $_POST['harga'];
                   $stok           = $_POST['stok'];
                   $status         = $_POST['status'];
                   $foto           = $_POST['foto'];
                   // data gambar  baru
                   $filename = $_FILES['gambar']['name'];
                   $tmp_name = $_FILES['gambar']['tmp_name'];

                   $type1    = explode('.',$filename);
                   $type2    = $type1[1];
                   $newname  = 'barang'.time().'.'.$type2;

                   // menampung data format file yang diizinkan
                   $tipe_diizinkan = array('jpg', 'jpeg', 'png', 'gif');

                   // jika admin ganti gambar
                    if($filename != ''){
                        // validasi format file
                        if(!in_array($type2, $tipe_diizinkan)){
                        //proses format jika tidak dizinkan
                            echo '<script>alert("Format file tidak dizinkan")</script>';
                        }else{
                            unlink('./produk/'.$foto);
                            move_uploaded_file($tmp_name, './produk/'.$newname);
                            $namagambar = $newname;
                        }
                    }else{
                        // jika admin tidak gantik gambar
                        $namagambar = $foto;
                    }
                   // query update data produk
                    $update = mysqli_query($conn, "UPDATE barang SET 
                    kategori_id = '".$kategori."',
                    nm_barang   = '".$nama."', 
                    spesifikasi = '".$spesifikasi."', 
                    harga       = '".$harga."', 
                    stok        = '".$stok."', 
                    gmr_barang  = '".$namagambar."', 
                    status      = '".$status."' WHERE barang_id = '".$p->barang_id."' ");

                    if($update){
                        echo '<script>alert("Ubah Data Berhasil")</script>';
                        echo '<script>window.location = "barang.php"</script>';
                    }else{
                        echo 'gagal'.mysqli_error($conn);
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