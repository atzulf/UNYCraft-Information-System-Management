<?php 
    session_start();
    if($_SESSION['login']==false){
        header("Location: ../index.php?pesan=belum_login");  
    }
     
    include '../koneksi.php';

    $queryKategori = mysqli_query($koneksi, "SELECT * FROM tabel_kategori");

    function generateRandomString($length = 10) {
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
    <title>Tambah produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<style>
      body {
            background-color: #f8f9fa;
        }

        .panel {
            background-color: #fff;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
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
            <h3>Tambah Produk</h3>
            </div>
        
            <div class="panel-body">
            <form ation="" method="post" enctype="multipart/form-data">
                <div>
                    <label for="nama">Nama</label>
                    <input type="text" id="nama" name="nama" class="form-control" autocomplete="off">
                </div>
                <div>
                    <label for="kategori">Kategori</label>
                    <select name="kategori" id="kategori" class="form-control">
                        <option value="">Pilih Satu</option>
                        <?php
                            while($data=mysqli_fetch_array($queryKategori)){
                        ?>
                            <option value="<?php echo $data['kategori_id']; ?>"><?php echo $data['nama_kategori'];?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="harga">Harga</label>
                    <input type="number" class="form-control" name="harga">
                </div>
                <div>
                    <label for="foto">Foto</label>
                    <input type="file" name="foto" id="foto" class="form-control">
                </div>
                <div>
                    <label for="detail">Detail</label>
                    <textarea name="detail" id="detail" cols="30" rows="10" class="form-control"></textarea>
                </div>
                <div>
                    <label for="ketersediaan_stok">Ketersediaan Stock</label>
                    <select name="ketersediaan_stok" id="ketersediaan_stok" class="form-control">
                        <option value="tersedia">tersedia</option>
                        <option value="habis">habis</option>
                    </select>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                </div>
            </form>
            </div>
            <?php
                if(isset($_POST['simpan'])){
                    $nama = htmlspecialchars($_POST['nama']);
                    $kategori = htmlspecialchars($_POST['kategori']);
                    $harga = htmlspecialchars($_POST['harga']);
                    $detail = htmlspecialchars($_POST['detail']);
                    $ketersediaan_stok = htmlspecialchars($_POST['ketersediaan_stok']);

                    $foto = $_FILES['foto']['name'];

                    // Pindahkan file gambar ke folder "image"
                    $folderTujuan = "../image/";
                    move_uploaded_file($_FILES['foto']['tmp_name'], $folderTujuan . $foto);
                    

                    if($nama=='' || $kategori=='' || $harga==''){
            ?>
                        <div class="alert alert-warning mt-3" role="alert">
                            Nama, kategori dan harga wajib diisi.
                        </div>
            <?php
                    }else {
                        // query insert to product table
                        $queryTambah = mysqli_query($koneksi, "INSERT INTO tabel_produk (kategori_id, nama_produk, harga_produk,  foto_produk, detail_produk, ketersediaan_stok) 
                        VALUES ('$kategori','$nama','$harga','$foto','$detail','$ketersediaan_stok')");
                
                        if ($queryTambah) {
                            ?>
                            <div class="alert alert-primary mt-3" role="alert">
                            Produk Berhasil Ditambah.
                            </div>
                            <meta http-equiv="refresh" content="2; url=produk1.php" />
                            <?php
                        } else {
                            echo mysqli_error($koneksi);
                        }
                    }
                }
                ?>
        </div>
        </div>
    </div>
</body>
</html>