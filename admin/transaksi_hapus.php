<?php
// koneksi database
include '../koneksi.php';

//menangkap data id yang dikirim dari url
$id = $_GET['id'];

//menghapus transaksi
mysqli_query($koneksi, "delete from tabel_transaksi where transaksi_id='$id'");

//alihkan halaman ke halaman transaksi
header("location:transaksi.php");
?>