<?php
    session_start();
    if($_SESSION['login']==false){
        header("Location: ../index.php?pesan=belum_login");  
    }
    
    include '../koneksi.php';

    $nama = htmlspecialchars ($_GET['nama']);
    $queryProduk = mysqli_query($koneksi, "SELECT * FROM tabel_produk WHERE nama_produk='$nama'");
    $produk = mysqli_fetch_array($queryProduk);

    $queryProdukTerkait = mysqli_query($koneksi, "SELECT * FROM tabel_produk WHERE kategori_id='$produk[kategori_id]' AND produk_id != '$produk[produk_id]' LIMIT 2");
    $produkTerkait = mysqli_fetch_array($queryProdukTerkait);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Online | Detail Produk</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <?php 
    
    include 'navbar2.php'; 
?>

    <div class="container-fluid py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 mb-4">
                    <img src="../image/<?php echo $produk['foto_produk'];?>" class="w-100" alt="">
                </div>
                <div class="col-lg-6 offset-lg-1">
                    <h1><?php echo $produk['nama_produk'];?></h1>
                    <p class="fs-5 mt-3">
                        <?php echo $produk['detail_produk'];?>
                    </p>
                    <p class="text-harga">
                        Rp. <?php echo $produk['harga_produk'];?>
                    </p>
                    <p class="fs-5">status ketersediaan : <strong> <?php echo $produk['ketersediaan_stok'];?>
                        </strong>
                    </p>
                    <!-- Form Tambah ke Keranjang -->
                    <form action="add_to_cart.php" method="post">
                        <input type="hidden" name="produk_id" value="<?php echo $produk['produk_id']; ?>">
                        <input type="hidden" name="nama_produk" value="<?php echo $produk['nama_produk']; ?>">
                        <input type="hidden" name="harga_produk" value="<?php echo $produk['harga_produk']; ?>">
                        <label for="quantity" class="form-label">Jumlah:</label>
                        <input type="number" name="quantity" id="quantity" class="form-control mb-3" min="1" value="1"
                            required>
                        <button type="submit" class="btn btn-success">Tambah ke Keranjang</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- produk terkait -->
    <div class="container-fluid py-5 warna2 mb-4">
        <div class="container text-center">
            <h2 class="text-black mb-5">Produk Terkait</h2>
            <div class="row mt-5 justify-content-center">
                <?php while ($data = mysqli_fetch_array($queryProdukTerkait)){ ?>
                <div class="col-md-3 col-lg-3 mb-3">
                    <div class="card rounded">
                        <div class="image-box">
                            <a href="produk_detail.php?nama=<?php echo $data['nama_produk']; ?>">
                                <img src="../image/<?php echo $data['foto_produk']; ?>"
                                    class="img-fluid img-thumbnail produk-terkait-image" alt="">
                            </a>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <?php require "footer.php";?>

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