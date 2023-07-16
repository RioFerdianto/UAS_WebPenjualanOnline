<?php
    session_start();
    include'koneksi.php';
    if($_SESSION['status_login'] != true){
        echo '<script>window.location="login.php"</script>';
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>kategori | Fa@Distro</title>
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
            <h3>Kategori</h3>
            <div class="box">
                <p><a href="tambah_kategori.php">Tambah Data Kategori</a></p>
                <table border="1"cellspasing="0" class="table">
                    <thead>
                        <tr>
                            <th width="60px">No.</th>
                            <th>Kategori Barang</th>
                            <th width="130px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $no = 1;
                            $kategori = mysqli_query($conn, "SELECT * FROM kategori ORDER BY kategori_id DESC");
                            if(mysqli_num_rows($kategori)> 0){
                                while($row = mysqli_fetch_array($kategori)){
                        ?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $row['nm_kategori']?></td>
                            <td>
                                <a href="edit_kategori.php?id=<?php echo $row['kategori_id']?>">EDIT</a> || <a href="hapus_kategori.php?idk=<?php echo $row['kategori_id']?>" onclick="return confirm('Apakah Anda yakin menghapus?')">HAPUS</a>
                            </td>
                        </tr>
                        <?php }}else{?>
                            <tr>
                                <td colspan="3">Tidak ada data</td>
                            </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--footer-->
    <div class="container">
        <small>Copyright &copy;2023 - RioFerdianto</small>
    </div>
</body>
</html>