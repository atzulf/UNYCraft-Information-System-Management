<?php
// koneksi database
include '../koneksi.php';

// ambil data yang dikirim dari form
$harga_produk_id = $_POST['Harga'];
$jenis_produk = $_POST['produk'];
$jumlah = $_POST['jumlah'];
$tanggal = $_POST['tanggal'];
$pelanggan = $_POST['pelanggan'];
$status = 0;

//ambil nama customer dari database berdasarkan id
$result = mysqli_query($koneksi, "SELECT nama_customer FROM tabel_customer WHERE id_customer = '$pelanggan'");


//ambil nama produk dari database berdasarkan id
$result = mysqli_query($koneksi, "SELECT nama_produk FROM tabel_produk WHERE produk_id = '$jenis_produk'");

// ambil harga produk dari database berdasarkan id
$result = mysqli_query($koneksi, "SELECT harga_produk FROM tabel_produk WHERE produk_id = '$harga_produk_id'");
$data_produk = mysqli_fetch_assoc($result);
$harga_produk = $data_produk['harga_produk'];

// hitung total transaksi
$total_transaksi = $harga_produk * $jumlah;

// simpan data ke dalam tabel transaksi
mysqli_query($koneksi, "INSERT INTO tabel_transaksi (harga_transaksi, jumlah_transaksi, total_transaksi, transaksi_tgl, nama_pelanggan, transaksi_status, produk) VALUES ('$harga_produk_id', '$jumlah', '$total_transaksi', '$tanggal', '$pelanggan', '$status', '$jenis_produk')");

// arahkan kembali ke halaman transaksi.php
header("location: transaksi.php");
?>
