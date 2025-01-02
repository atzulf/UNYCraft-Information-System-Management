<?php
include '../koneksi.php';

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $hapus = mysqli_query($koneksi, "DELETE FROM tabel_produk WHERE produk_id = '$id'");
    
    if($hapus) {
        // Redirect ke halaman produk.php dengan menyertakan parameter 'pesan'
        header("Location: produk1.php?pesan=hapus_sukses");
    } else {
        echo "Gagal menghapus data.";
    }
} else {
    header("Location: produk1.php");
}
?>
