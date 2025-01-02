<?php 
    session_start();
    if($_SESSION['login']==false){
        header("Location: ../index.php?pesan=belum_login");  
    }
    
    include '../koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
                    <i class="fas fa-box me-1"></i>Produk
                </li>
            </ol>
        </nav>

        <div class="mt-3 mb-5">
            <h2>List Produk</h2>
            <a href="produk_tambah.php" class="btn btn-sm btn-info pull-right mt-3">Tambah</a>

            <?php
            // Notifikasi stok habis
            $stokHabisQuery = mysqli_query($koneksi, "SELECT * FROM tabel_produk WHERE ketersediaan_stok = 'Habis' ORDER BY nama_produk ASC");
            if (mysqli_num_rows($stokHabisQuery) > 0) {
                echo "<div class='alert alert-danger mt-3' role='alert'>";
                echo "<strong>Perhatian!</strong> Berikut produk yang stoknya habis:";
                echo "<ul>";
                while ($stokHabis = mysqli_fetch_assoc($stokHabisQuery)) {
                    echo "<li>{$stokHabis['nama_produk']} - Stok: {$stokHabis['ketersediaan_stok']}</li>";
                }
                echo "</ul>";
                echo "</div>";
            }
            ?>


            <?php
            // Tampilkan pemberitahuan jika ada parameter 'pesan' dengan nilai 'hapus_sukses'
            if(isset($_GET['pesan']) && $_GET['pesan'] == 'hapus_sukses') {
            ?>
            <div class="alert alert-primary mt-3" role="alert">
                Produk Berhasil Dihapus.
            </div>
            <meta http-equiv="refresh" content="1; url=produk1.php" />
            <?php
            }
            ?>

            <div class="table-responsive mt-5">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Foto</th>
                            <th>Harga</th>
                            <th>Ketersediaan Stok</th>
                            <th width="20%">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $dataproduk = mysqli_query($koneksi, "SELECT a.*, b.nama_kategori AS nama_kategori FROM tabel_produk a INNER JOIN tabel_kategori b ON a.kategori_id = b.kategori_id ORDER BY a.nama_produk ASC");
                        $jumlahproduk = mysqli_num_rows($dataproduk); 
                        if($jumlahproduk == 0) {
                        ?>
                        <tr>
                            <td colspan=9 class="text-center">Data Produk Tidak Tersedia.</td>
                        </tr>
                        <?php
                        } else {
                            $jumlah = 1;
                            while($data = mysqli_fetch_array($dataproduk)) {
                        ?>
                        <tr>
                            <td><?php echo $jumlah; ?></td>
                            <td><?php echo $data['nama_produk']; ?></td>
                            <td><?php echo $data['nama_kategori']; ?></td>
                            <td>
                                <img src="../image/<?php echo $data['foto_produk']; ?>" alt="Foto"
                                    style="max-width: 100px; max-height: 100px;">
                            </td>
                            <td><?php echo "Rp. ".number_format($data['harga_produk']).",00"; ?></td>
                            <td><?php echo $data['ketersediaan_stok']; ?></td>
                            <td>
                                <a href="produk_edit.php?id=<?php echo $data['produk_id']; ?>"
                                    class="btn btn-sm btn-warning"><i class="fas fa-cogs me-1"></i>Edit</a>
                                <a href="produk_hapus.php?id=<?php echo $data['produk_id']; ?>"
                                    class="btn btn-sm btn-danger"><i class="fas fa-trash me-1"></i>Hapus</a>
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