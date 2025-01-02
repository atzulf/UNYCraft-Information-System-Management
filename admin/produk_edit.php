<?php
session_start();
if($_SESSION['login']==false){
    header("Location: ../index.php?pesan=belum_login");  
}

include '../koneksi.php';

$query = mysqli_query($koneksi, "SELECT a.*, b.nama_kategori AS nama_kategori FROM tabel_produk a INNER JOIN tabel_kategori b ON a.kategori_id = b.kategori_id ORDER BY a.nama_produk ASC");
$data = mysqli_fetch_array($query);

$queryKategori = mysqli_query($koneksi, "SELECT * FROM tabel_kategori");

function generateRandomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<style>
    body {
        background-color: #f8f9fa;
    }

    .panel {
        background-color: #fff;
        box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
        padding: 20px;
        border-radius: 8px;
    }

    .form-control {
        margin-bottom: 15px;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }

    .alert {
        margin-top: 15px;
    }
</style>

<body>
    <?php include 'navbar1.php'; ?>
    <div class="container mt-5">
        <div class="my-5 col-12 col-md-6-offset-3">
            <div class="panel">
                <div class="panel-heading">
                    <h3>Edit Produk</h3>
                </div>

                <div class="panel-body">
                    <?php
                    $id = $_GET['id'];
                    $dataproduk = mysqli_query($koneksi, "SELECT * FROM tabel_produk WHERE produk_id = '$id'");
                    while ($data = mysqli_fetch_array($dataproduk)) { ?>

                        <form action="" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id_produk" value="<?php echo $id; ?>">
                            <div>
                                <label for="nama">Nama</label>
                                <input type="text" id="nama" name="nama" class="form-control" autocomplete="off" value="<?php echo $data['nama_produk']; ?>">
                            </div>
                            <div>
                                <label for="kategori">Kategori</label>
                                <select name="kategori" id="kategori" class="form-control">
                                    <option value="">-- Pilih Satu --</option>
                                    <?php
                                    while ($kategori = mysqli_fetch_array($queryKategori)) {
                                        $selected = ($kategori['kategori_id'] == $data['kategori_id']) ? 'selected' : '';
                                    ?>
                                        <option value="<?php echo $kategori['kategori_id']; ?>" <?php echo $selected; ?>><?php echo $kategori['nama_kategori']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div>
                                <label for="harga">Harga</label>
                                <input type="number" class="form-control" name="harga" value="<?php echo $data['harga_produk']; ?>">
                            </div>
                            <div>
                                <label for="foto">Foto</label>
                                <img src="../image/<?php echo $data['foto_produk']; ?>" alt="" width="350px">
                                <input type="file" name="foto" id="foto" class="form-control mt-3">
                            </div>
                            <div>
                                <label for="detail">Detail</label>
                                <textarea name="detail" id="detail" cols="30" rows="10" class="form-control"><?php echo $data['detail_produk']; ?></textarea>
                            </div>
                            <div>
                                <label for="ketersediaan_stok">Ketersediaan Stock</label>
                                <select name="ketersediaan_stok" id="ketersediaan_stok" class="form-control">
                                    <option value="tersedia" <?php echo ($data['ketersediaan_stok'] == 'tersedia') ? 'selected' : ''; ?>>tersedia</option>
                                    <option value="habis" <?php echo ($data['ketersediaan_stok'] == 'habis') ? 'selected' : ''; ?>>habis</option>
                                </select>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                            </div>
                        </form>
                        <?php } ?>
                </div>
            </div>
        </div>
        <?php

        if (isset($_POST['simpan'])) {
            $id_produk = $_POST['id_produk'];
            $nama = htmlspecialchars($_POST['nama']);
            $kategori = htmlspecialchars($_POST['kategori']);
            $harga = htmlspecialchars($_POST['harga']);
            $detail = htmlspecialchars($_POST['detail']);
            $ketersediaan_stok = htmlspecialchars($_POST['ketersediaan_stok']);

            $foto = $_FILES['foto']['name'];

            // Pindahkan file gambar ke folder "image" hanya jika ada file yang diunggah
            if ($_FILES['foto']['size'] > 0) {
                $folderTujuan = "../image/";
                move_uploaded_file($_FILES['foto']['tmp_name'], $folderTujuan . $foto);
            } else {
                // Jika tidak ada file yang diunggah, gunakan foto yang sudah ada
                $data_produk = mysqli_query($koneksi, "SELECT * FROM tabel_produk WHERE produk_id = '$id_produk'");
                $produk = mysqli_fetch_assoc($data_produk);
                $foto = $produk['foto_produk'];
            }

            // Cek apakah nama, kategori, dan harga kosong
            if ($nama == '' || $kategori == '' || $harga == '') {
                ?>
                <div class="alert alert-warning mt-3" role="alert">
                    Nama, kategori, dan harga wajib diisi.
                </div>
                <?php
            } else {
                // query update produk
                $queryUpdate = mysqli_query($koneksi, "UPDATE tabel_produk SET
                    kategori_id = '$kategori',
                    nama_produk = '$nama',
                    harga_produk = '$harga',
                    foto_produk = '$foto',
                    detail_produk = '$detail',
                    ketersediaan_stok = '$ketersediaan_stok'
                WHERE produk_id = '$id_produk'");

                if ($queryUpdate) {
                    ?>
                    <div class="alert alert-primary mt-3" role="alert">
                        Produk Berhasil Diupdate.
                    </div>
                    <meta http-equiv="refresh" content="1; url=produk1.php" />
                    <?php
                } else {
                    echo mysqli_error($koneksi);
                }
            }
        }
        ?>
    </div>
</body>
</html>