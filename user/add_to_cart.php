<?php
session_start();

// Periksa apakah POST memiliki data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $produk_id = $_POST['produk_id'] ?? null;
    $nama_produk = $_POST['nama_produk'] ?? '';
    $harga_produk = $_POST['harga_produk'] ?? 0;
    $quantity = $_POST['quantity'] ?? 1;

    // Validasi
    if (!$produk_id || !is_numeric($produk_id) || $quantity < 1) {
        die("Data tidak valid.");
    }

    // Inisialisasi keranjang
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Tambahkan atau perbarui produk di keranjang
    if (isset($_SESSION['cart'][$produk_id])) {
        // Perbarui jumlah produk di keranjang
        $_SESSION['cart'][$produk_id]['quantity'] = $quantity; // Menggunakan jumlah dari form
    } else {
        // Tambahkan produk baru ke keranjang
        $_SESSION['cart'][$produk_id] = [
            'produk_id' => $produk_id,
            'nama_produk' => $nama_produk,
            'harga_produk' => $harga_produk,
            'quantity' => $quantity,
        ];
    }

    // Redirect ke halaman keranjang
    header("Location: cart.php");
    exit();
} else {
    die("Akses tidak valid.");
}
?>