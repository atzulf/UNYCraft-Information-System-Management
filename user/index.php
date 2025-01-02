<?php
    session_start();
    if($_SESSION['login']==false){
        header("Location: ../index.php?pesan=belum_login");  
    }
    
    include '../koneksi.php';

    $queryProduk = mysqli_query($koneksi, "SELECT produk_id, nama_produk, harga_produk, foto_produk, detail_produk FROM tabel_produk LIMIT 3");
    $dataProduk = mysqli_num_rows($queryProduk);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UNYCraft</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <?php include 'navbar2.php'; ?>

    <div class="container-fluid banner d-flex align-items-center">
        <div class="container text-center text-white">
            <h1>UNY Craft Market</h1>
            <h3>"Aplikasi E-commerce kerajinan tangan"</h3>
        </div>
    </div>


    <div class="container-fluid py-5">
        <div class="container text-center">
            <h3>Kategori Unggulan</h3>

            <div class="row mt-5">
                <div class="col-md-4 mb-3">
                    <div class="produk-unggul unggul1 d-flex justify-content-center align-items-center rounded">
                        <h3 class="text-white"><a class="no-decoration"
                                href="produk.php?kategori=Kerajinan Gerabah">Kerajinan Gerabah</a></h3>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="produk-unggul unggul2 d-flex justify-content-center align-items-center rounded">
                        <h3 class="text-white"><a class="no-decoration"
                                href="produk.php?kategori=Kerajinan Kulit">Kerajinan Kulit</a></h3>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="produk-unggul unggul3 d-flex justify-content-center align-items-center rounded">
                        <h3 class="text-white"><a class="no-decoration"
                                href="produk.php?kategori=Kerajinan Kayu">Kerajinan Kayu</a>
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid warna3 py-5">
        <div class="container text-center">
            <img src="../image/eeleh.png" alt="Deskripsi Gambar">
            <!-- <h3>Remember!</h3>
            <p class="fs-4 mt-3">يَا أَيُّهَا الَّذِينَ آمَنُوا لا تُلْهِكُمْ أَمْوَالُكُمْ وَلا أَوْلادُكُمْ عَنْ
                ذِكْرِ اللَّهِ وَمَنْ يَفْعَلْ ذَلِكَ فَأُولَئِكَ هُمُ الْخَاسِرُونَ<br>
                Artinya: “Hai orang-orang yang beriman, janganlah harta-hartamu dan anak-anakmu melalaikan kamu dari
                mengingat Allah. Barangsiapa yang membuat demikian maka mereka itulah orang-orang yang rugi,” (QS Al
                Munafiqun: 9).</p> -->
        </div>
    </div>

    <div class="container-fluid py-5">
        <div class="container text-center">
            <h3>Produk</h3>

            <div class="row mt-5">
                <?php while ($data = mysqli_fetch_array($queryProduk)) { ?>
                <div class="col-sm-6 col-md-4 mb-3">
                    <div class="card rounded">
                        <div class="image-box">
                            <img src="../image/<?php echo $data['foto_produk']; ?>" class="card-img-top" alt="...">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $data['nama_produk']; ?></h5>
                            <p class="card-text text-truncate"><?php echo $data['detail_produk']; ?></p>
                            <p class="card-text text-harga"><?php echo $data['harga_produk']; ?></p>
                            <a href="produk_detail.php?nama=<?php echo $data ['nama_produk']; ?>"
                                class="btn text-white warna4">Lihat Detail</a>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
            <a class="btn btn-outline-warning mt-3 p-3" href="produk.php">See More</a>
        </div>
    </div>



    <?php include 'footer.php'; ?>

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