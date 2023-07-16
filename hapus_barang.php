<?php
    include 'koneksi.php';

    if(isset($_GET['idk'])){
        $delete = mysqli_query($conn, "DELETE FROM kategori WHERE kategori_id = '".$_GET['idk']."' ");
        echo '<script>window.location = "kategori.php"</script>';
    }
    if(isset($_GET['idp'])){
        $barang = mysqli_query($conn, "SELECT gmr_barang FROM barang WHERE barang_id = '".$_GET['idp']."' ");
        $p = mysqli_fetch_object($barang);

        unlink('./produk/'.$p->gmr_barang);

        $delete = mysqli_query($conn, "DELETE FROM barang WHERE barang_id = '".$_GET['idp']."' ");
        echo '<script>window.location = "barang.php"</script>';
    }
?>