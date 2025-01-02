<?php
session_start();

// Memeriksa apakah keranjang kosong
if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) {
    echo "<h3>Keranjang Anda kosong!</h3>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>

    <?php include 'navbar2.php'; ?>

    <div class="container my-5">
        <h2>Keranjang Belanja</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="cart-items">
                <?php
                $total_harga = 0;
                foreach ($_SESSION['cart'] as $item) {
                    $sub_total = $item['harga_produk'] * $item['quantity'];
                    $total_harga += $sub_total;
                    echo "<tr id='item-{$item['produk_id']}'>
                        <td>{$item['nama_produk']}</td>
                        <td>Rp. " . number_format($item['harga_produk'], 0, ',', '.') . "</td>
                        <td>{$item['quantity']}</td>
                        <td>Rp. " . number_format($sub_total, 0, ',', '.') . "</td>
                        <td>
                            <button class='btn btn-danger btn-sm remove-item' data-produk-id='{$item['produk_id']}'>Hapus</button>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
        <h3 id="total-harga">Total Harga: Rp. <?php echo number_format($total_harga, 0, ',', '.'); ?></h3>
        <a href="checkout.php" class="btn btn-success">Checkout</a>
    </div>
    <?php include 'footer.php'; ?>
</body>
<script>
$(document).ready(function() {
    $(".remove-item").click(function() {
        const produkId = $(this).data("produk-id");
        const row = $("#item-" + produkId);

        if (confirm("Apakah Anda yakin ingin menghapus produk ini dari keranjang?")) {
            $.ajax({
                url: "remove_from_cart.php",
                type: "POST",
                data: {
                    produk_id: produkId
                },
                success: function(response) {
                    row.remove();
                    $("#total-harga").text("Total Harga: Rp. " + response.total_harga);
                    alert("Produk berhasil dihapus dari keranjang!");
                },
                error: function() {
                    alert(
                        "Terjadi kesalahan saat menghapus produk. Silakan coba lagi."
                    );
                },
            });
        }
    });

    // Bot interaction logic
    const botButton = document.getElementById("kms-bot");
    const botModal = document.getElementById("kms-bot-modal");
    const botClose = document.querySelector(".kms-bot-close");

    botButton.addEventListener("click", () => {
        botModal.style.display = "block";
    });

    botClose.addEventListener("click", () => {
        botModal.style.display = "none";
    });

    window.addEventListener("click", (event) => {
        if (event.target === botModal) {
            botModal.style.display = "none";
        }
    });
});
</script>


</html>