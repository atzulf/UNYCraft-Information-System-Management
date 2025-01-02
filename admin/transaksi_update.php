<?php
// koneksi database
include '../koneksi.php';

// ambil data yang dikirim dari form
$id_transaksi = $_POST['id_transaksi'];
$harga_produk_id = $_POST['Harga'];
$jenis_produk = $_POST['produk'];
$jumlah = $_POST['jumlah'];
$tanggal = $_POST['tanggal'];
$pelanggan = $_POST['pelanggan'];
$status = 0;

//ambil nama customer dari database berdasarkan id
$result = mysqli_query($koneksi, "SELECT nama_customer FROM tabel_customer WHERE id_customer = '$pelanggan'");

// ambil harga produk dari database berdasarkan id
$result_harga = mysqli_query($koneksi, "SELECT harga_produk FROM tabel_produk WHERE produk_id = '$harga_produk_id'");
$data_harga = mysqli_fetch_assoc($result_harga);
$harga_produk = $data_harga['harga_produk'];

// hitung total transaksi
$total_transaksi = $harga_produk * $jumlah;


// update data transaksi
mysqli_query($koneksi, "UPDATE tabel_transaksi SET harga_transaksi = '$harga_produk_id', produk = '$jenis_produk', jumlah_transaksi = '$jumlah', total_transaksi = '$total_transaksi', transaksi_tgl = '$tanggal', nama_pelanggan = '$pelanggan', transaksi_status = '$status' WHERE transaksi_id = '$id_transaksi'");

header("location: transaksi.php");
?>
