<?php 
    session_start();
    if($_SESSION['login']==false){
        header("Location: ../index.php?pesan=belum_login");  
    } 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UNYCraft | About Us</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <?php include'navbar2.php' ?>

    <!-- Banner -->
    <div class="container-fluid banner3 d-flex align-items-center">
        <div class="container">
            <h2 class="text-white text-center">About Us</h2>
        </div>
    </div>

    <div class="container-fluid py-5">
        <div class="container fs-5 text-center">
            <!-- Your text content here -->
            <p>Selamat datang di UNYCraft Market, platform e-commerce yang menghadirkan keindahan dan keunikan kerajinan
                tangan dari para pengrajin berbakat di seluruh Indonesia. Kami percaya bahwa setiap karya kerajinan
                memiliki cerita, tradisi, dan nilai yang berharga, yang layak untuk dijaga dan dihargai.Sebagai platform
                yang menghubungkan pencinta seni dengan para pengrajin, kami ingin menjadi jembatan yang mendukung
                ekonomi kreatif serta mempromosikan keberlanjutan industri kerajinan tangan. Dengan desain yang modern
                dan pengalaman pengguna yang ramah, kami memudahkan setiap orang untuk menemukan dan membeli kerajinan
                tangan favorit mereka.
            </p>
        </div>
    </div>

    <div class="container-fluid warna3 py-5">
        <div class="container text-center">
            <h3>Informasi Pembuat</h3>
        </div>
    </div>

    <div class="container-fluid">
        <div class="container text-center d-flex flex-wrap justify-content-center mt-4 mb-3">
            <!-- Card Section -->

            <div class="card mx-2 my-3 border-0" style="width: 18rem;">
                <img src="../image/mypoto.jpg" class="card-img-top rounded-circle" alt="Card Image">
                <div class="card-body">
                    <h5 class="card-title">Ataka Dzulfikar (22537141002)</h5>
                    <p class="card-text">Informatics engineering student at Yogyakarta State University</p>
                </div>
                <div class="card-body">
                    <a href="https://www.instagram.com/atakazulfikar/" class="card-link" style="font-size: 24px;"><i
                            class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </div>

    <?php include'footer.php'; ?>
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