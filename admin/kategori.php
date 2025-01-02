<?php 
session_start();
if($_SESSION['login']==false){
    header("Location: ../index.php?pesan=belum_login");  
}
 
include '../koneksi.php';

$datakategori = mysqli_query($koneksi, "select * from tabel_kategori");
$jumlahkategori = mysqli_num_rows($datakategori);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        .no-decoration {
            text-decoration: none !important;
        }
    </style>
</head>
<body>
    <?php include 'navbar1.php'; ?>
    <div class="container mt-5">
    <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="../admin/index1.php" class="no-decoration text-muted">
                        <i class="fa fa-home me-1"></i>Home
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <i class="fas fa-th-list me-1"></i>Kategori
                </li>
            </ol>
        </nav>

        <div class="my-5 col-12 col-md-6">
            <h3>Tambah Kategori</h3>

            <form action="" method="post">
                <div>
                    <label for="kategori">Kategori</label>
                    <input type="text" id="kategori" name="kategori" placeholder="input nama kategori" class="form-control">
                </div>
                <div class="mt-3">
                    <button class="btn btn-primary" type="submit" name="simpan_kategori">Simpan</button>
                </div>
            </form>

            <?php
                if(isset($_POST['simpan_kategori'])) {
                    $kategori = $_POST['kategori'];
                    $data = mysqli_query($koneksi, "select nama_kategori from tabel_kategori where nama_kategori='$kategori'");
                    $jumlahDataKategoribaru = mysqli_num_rows($data);

                    if($jumlahDataKategoribaru > 0) {
                        ?>
                        <div class="alert alert-warning mt-3" role="alert">
                            Kategori Sudah Tersedia.
                        </div>
                        <?php
                    } else {
                        $simpan = mysqli_query($koneksi, "insert into tabel_kategori (nama_kategori) values ('$kategori')");

                        if($simpan){
                            ?>
                            <div class="alert alert-primary mt-3" role="alert">
                                Kategori Berhasil Ditambah.
                            </div>
                            <meta http-equiv="refresh" content="1; url=kategori.php" />
                        <?php
                        }
                        else {
                            echo mysqli_error($koneksi);
                        }
                    }
                }
            ?>
        </div>

        <div class="mt-3">
            <h2>List kategori</h2>

            <div class="table-responsive mt-5">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama.</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if($jumlahkategori == 0) {
                        ?>
                             <tr>
                                 <td colspan=3 class="text-center">Data Kategori Tidak Tersedia.</td>
                             </tr>
                        <?php
                            } else {
                                $jumlah = 1;
                                while($data=mysqli_fetch_array($datakategori)) {
                        ?>
                                    <tr>
                                        <td><?php echo $jumlah;  ?></td>
                                        <td><?php echo $data['nama_kategori']; ?></td>
                                        <td>
                                            <a href="kategori_detail.php?p=<?php echo $data['kategori_id']; ?>" class="btn btn-info"><i class="fas fa-cogs"></i></a>
                                        </td>
                                    </tr>
                        <?php
                                $jumlah++;
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>