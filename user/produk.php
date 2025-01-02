<?php
    session_start();
    if($_SESSION['login']==false){
        header("Location: ../index.php?pesan=belum_login");  
    }
    
    include '../koneksi.php';

    $querykategori = mysqli_query($koneksi, "SELECT * FROM tabel_kategori");

    // Produk dari kategori
    if(isset($_GET['kategori'])) {
        $queryGetKategori = mysqli_query($koneksi, "SELECT kategori_id FROM tabel_kategori WHERE nama_kategori='$_GET[kategori]'");
        $kategoriId = mysqli_fetch_array($queryGetKategori);

        $queryProduk = mysqli_query($koneksi, "SELECT * FROM tabel_produk where kategori_id='$kategoriId[kategori_id]'");
    
    // Produk dari default
    } else {
        $queryProduk = mysqli_query($koneksi, "SELECT * FROM tabel_produk");
    }

    $conData = mysqli_num_rows($queryProduk);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Online | Produk</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <?php include 'navbar2.php'; ?>

    <div class="container-fluid banner2 d-flex align-items-center">
        <div class="container">
            <h2 class="text-white text-center">Produk</h2>
        </div>
    </div>

    <div class="container py-5">
        <div class="row">
            <div class="col-lg-3 mb-5">
                <h3>Kategori</h3>
                <ul class="list-group">
                    <?php while($kategori = mysqli_fetch_assoc($querykategori)) { ?>
                    <a class="no-decoration" href="produk.php?kategori=<?php echo $kategori['nama_kategori']; ?>">
                        <li class="list-group-item"><?php echo $kategori['nama_kategori']; ?></li>
                    </a>
                    <?php } ?>
                </ul>
            </div>
            <div class="col-lg-9">
                <h3 class="text-center mb-3">Produk</h3>
                <div class="row">
                    <?php
                        if($conData < 1) {
                    ?>
                    <h4 class="text-center my-5">Produk Tidak Tersedia</h4>
                    <?php
                        }
                    ?>
                    <?php while($produk = mysqli_fetch_assoc($queryProduk)) { ?>
                    <div class="col-md-4 mb-3">
                        <div class="card h-100">
                            <div class="image-box">
                                <img src="../image/<?php echo $produk['foto_produk']; ?>" class="card-img-top"
                                    alt="...">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $produk['nama_produk']; ?></h5>
                                <p class="card-text text-truncate"><?php echo $produk['detail_produk']; ?></p>
                                <p class="card-text text-harga">
                                    Rp.<?php echo number_format($produk['harga_produk'], 0, ',', '.'); ?></p>
                                <a href="produk_detail.php?nama=<?php echo $produk ['nama_produk']; ?>"
                                    class="btn warna4 text-white">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
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