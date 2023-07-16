<?php
    include'koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fa@Distro</title>
    <link rel="stylesheet" type="text/css" href="stlyle.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
</head>
<body>
    <!--header-->
    <header>
        <div class="container">
            <h1><a href="index.php">Rio Ferdianto</a></h1>
            <ul>
                <li><a href="barang.php">Data Barang</a></li>
            </ul>
        </div>
    </header>
    <!--pencarian-->
    <div class="search">
        <div class="container">
            <form action="barang.php" method="">
                <input type="text" name="search" placeholder="Cari Barang">
                <input type="submit" name="cari" placeholder="Cari Barang">
            </form>
        </div>
    </div>

    <!--kategori-->
    <div class="section">
        <div class="container">
            <h3>Kategori</h3>
            <div class="box">
                <?php
                    $kategori = mysqli_query($conn, "SELECT * FROM kategori ORDER BY kategori_id DESC");
                    if(mysqli_num_rows($kategori) > 0){
                        while($k = mysqli_fetch_array($kategori)){

                ?>
                    <a href="barang.php?kat=<?php echo $k['kategori_id']?> ">
                        <div class="col-5">
                            <img src="img/icon-category-5.jpg" width="50px" style="margin-bottom: 5px;">
                            <p><?php echo $k['nm_kategori'] ?></p>
                        </div>
                    </a>
               <?php }}else{ ?>
                    <p>Kategori Tidak Ada</p>
               <?php } ?>
            </div>
        </div>
        <!--barang baru-->
        <div class="section">
            <div class="container">
                <h3>Barang Terbaru Di Toko Kami</h3>
                    <div class="box">
                        <?php 
                            $barang = mysqli_query($conn, "SELECT * FROM barang ORDER BY barang_id DESC LIMIT 8");
                            if(mysqli_num_rows($barang)> 0){
                                while($b = mysqli_fetch_array($barang)){
                        ?>
                        <a href="detail=barang.php?<?php echo $b['barang_id']?>">
                            <div class="col-4">
                                <img src="produk/<?php echo $b['gmr_barang'] ?>">
                                <p class="nama"><?php echo $b['nm_barang'] ?></p>
                                <p class="harga"><?php echo $b['harga'] ?></p>
                            </div>
                        </a>
                        <?php }}else{ ?>
                            <p>Produk Tidak Ada</p>
                        <?php }?>
                    </div>
            </div>
        </div>
    </div>

    <!--futter-->
    <div class="footer">
        <div class="container">
            <h4>Alamat</h4>
            <p>Kampung Kukun Desa Ciantra, Sukaresmi,Cikarang Selatan</p>
            <h4>Email</h4>
            <p>rio343ferdianto@gmail.com</p>
            <h4>No.HP</h4>
            <p>0858-9617-5411</p>
        <small>Copyright &copy;2023 - RioFerdianto</small>
        </div>
    </div>
</body>
</html>