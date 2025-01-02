<?php
session_start();

// Periksa apakah keranjang kosong
if (!isset($_SESSION['cart']) || count($_SESSION['cart']) === 0) {
    die("Keranjang Anda kosong! Silakan tambahkan produk terlebih dahulu.");
}

// Hitung total harga
$total_harga = 0;
foreach ($_SESSION['cart'] as $item) {
    $total_harga += $item['harga_produk'] * $item['quantity'];
}

// Simulasi nomor pesanan (biasanya ini dihasilkan dari database)
$order_id = rand(100000, 999999);

// Simpan detail pesanan (biasanya ini dimasukkan ke database)
// Disini hanya menggunakan sesi sebagai simulasi
$_SESSION['order'] = [
    'order_id' => $order_id,
    'items' => $_SESSION['cart'],
    'total_harga' => $total_harga,
    'tanggal' => date('d-m-Y H:i:s'),
];

// Kosongkan keranjang setelah checkout
unset($_SESSION['cart']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Berhasil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <?php include 'navbar2.php'; ?>
    <div class="container my-5">
        <h2>Checkout Berhasil!</h2>
        <p>Nomor Pesanan Anda: <strong>#<?php echo $order_id; ?></strong></p>
        <p>Tanggal: <strong><?php echo $_SESSION['order']['tanggal']; ?></strong></p>
        <h3>Detail Pesanan:</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($_SESSION['order']['items'] as $item) { ?>
                <tr>
                    <td><?php echo $item['nama_produk']; ?></td>
                    <td>Rp. <?php echo number_format($item['harga_produk'], 0, ',', '.'); ?></td>
                    <td><?php echo $item['quantity']; ?></td>
                    <td>Rp. <?php echo number_format($item['harga_produk'] * $item['quantity'], 0, ',', '.'); ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <h3>Total Harga: Rp. <?php echo number_format($total_harga, 0, ',', '.'); ?></h3>
        <hr>
        <button onclick="window.print()" class="btn btn-primary">Print</button>
        <a href="index.php" class="btn btn-success">Kembali ke Beranda</a>
    </div>

    <div class="position-absolute bottom-0 w-100">
        <?php include 'footer.php'; ?>
    </div>
</body>

<script>
// Get elements
const botButton = document.getElementById("kms-bot");
const botModal = document.getElementById("kms-bot-modal");
const botClose = document.querySelector(".kms-bot-close");

// Show modal on button click
botButton.addEventListener("click", () => {
    botModal.style.display = "block";
});

// Hide modal on close button click
botClose.addEventListener("click", () => {
    botModal.style.display = "none";
});

// Hide modal when clicking outside the modal content
window.addEventListener("click", (event) => {
    if (event.target === botModal) {
        botModal.style.display = "none";
    }
});
</script>

</html>