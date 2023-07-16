<?php
    include 'koneksi.php';
    if(isset($_GET['idk'])){
        $delete = mysqli_query($conn, "DELETE FROM kategori WHERE kategori_id = '".$_GET['idk']."' ");
        echo '<script>window.location="kategori.php"</script>';
    }
?>