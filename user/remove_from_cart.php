<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $produk_id = $_POST['produk_id'] ?? null;

    if ($produk_id && isset($_SESSION['cart'][$produk_id])) {
        // Hapus item dari keranjang
        unset($_SESSION['cart'][$produk_id]);

        // Hitung ulang total harga
        $total_harga = 0;
        foreach ($_SESSION['cart'] as $item) {
            $total_harga += $item['harga_produk'] * $item['quantity'];
        }

        // Kirim respon JSON
        echo json_encode(['status' => 'success', 'total_harga' => number_format($total_harga, 0, ',', '.')]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Produk tidak ditemukan']);
    }
    exit();
}