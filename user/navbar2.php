<nav class="navbar navbar-expand-lg navbar-light warna4">
    <div class="container">
        <img src="../image/logogo.png" alt="" width="30" height="30">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02"
            aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item me-4">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item me-4">
                    <a class="nav-link" href="produk.php">Produk</a>
                </li>
                <li class="nav-item me-4">
                    <a class="nav-link" href="about.php">About Us</a>
                </li>
                <li class="nav-item me-4">
                    <a class="nav-link" href="../logout.php">Logout</a>
                </li>
                <li class="nav-item">
                    <!-- Bot Button -->
                    <div id="kms-bot" class="kms-bot">
                        <i class="fas fa-robot"></i>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Modal untuk KMS Bot -->
<div id="kms-bot-modal" class="kms-bot-modal">
    <div class="kms-bot-modal-content">
        <span class="kms-bot-close">&times;</span>
        <iframe src="kms_bot_interface.php" width="100%" height="400px" style="border: none;"></iframe>
    </div>
</div>