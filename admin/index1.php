<?php 
session_start();
if($_SESSION['login']==false){
    header("Location: ../index.php?pesan=belum_login");  
} 

include '../koneksi.php';

$datakategori = mysqli_query($koneksi, "select * from tabel_kategori");
$jumlahkategori = mysqli_num_rows($datakategori);

$dataproduk = mysqli_query($koneksi, "select * from tabel_produk");
$jumlahproduk = mysqli_num_rows($dataproduk);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
     <!-- Font Awesome 5.15.4 -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<style>
        .kotak {
            border: solid;
        }

        .summary-kategori {
            background-color: #0a6b4a;
            border-radius: 15px
        }

        .summary-produk {
            background-color: #0a516b;
            border-radius: 15px
        }

        .no-decoration {
            text-decoration: none;
        }
    </style>
<body>
    <?php include 'navbar1.php'; ?>
    <div class="container mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <i class="fa fa-home"></i>Home
                </li>
        </ol>
        </nav>
    <h2>Hallo <?php echo $_SESSION['username']; ?> </h2>

        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-12 mb-3">
                    <div class="summary-kategori p-3">
                        <div class="row">
                            <div class="col-6">
                            <i class="fas fa-th-list fa-7x text-black-50"></i>
                            </div>
                            <div class="col-6 text-white">
                                <h3 class="fs-2">Kategori</h3>
                                <p class="fs-4"><?php echo $jumlahkategori; ?> Kategori</p>
                                <p><a href="../admin/kategori.php" class="text-white no-decoration">Lihat Detail</a></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-12 mb-3">
                    <div class="summary-produk p-3">
                        <div class="row">
                            <div class="col-6">
                            <i class="fas fa-box fa-7x text-black-50"></i>
                            </div>
                            <div class="col-6 text-white">
                                <h3 class="fs-2">Produk</h3>
                                <p class="fs-4"><?php echo $jumlahproduk; ?> Produk</p>
                                <p><a href="produk1.php" class="text-white no-decoration">Lihat Detail</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>