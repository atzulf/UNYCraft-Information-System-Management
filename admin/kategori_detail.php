<?php
    session_start();
    if($_SESSION['login']==false){
        header("Location: ../index.php?pesan=belum_login");  
    }
     
    include '../koneksi.php';

    $id = $_GET['p'];

    $data = mysqli_query($koneksi, "select * from tabel_kategori where kategori_id = '$id'");
    $cek = mysqli_fetch_array($data);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail kategori</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js">
    </script>
</head>
<body>
    <?php include 'navbar1.php'; ?>

    <div class="container mt-5">
        <h2>Detail kategori</h2>
        
        <div class="col-12 col-md-6">
            <form action="" method="post">
                <div>
                    <label for="kategori">Kategori</label>
                    <input type="text" name="kategori" id="kategori" class="form-control" value="<?php echo $cek['nama_kategori']; ?>">
                </div>

                <div class="mt-5">
                    <button type="submit" class="btn btn-primary" name="editBtn">Edit</button>
                    <button type="submit" class="btn btn-danger" name="deleteBtn">Delete</button>
                </div>
            </form>

            <?php
                if(isset($_POST['editBtn'])) {
                    $kategori = htmlspecialchars($_POST['kategori']);

                    if($cek['nama_kategori']==$kategori) {
                        ?>
                        <meta http-equiv="refresh" content="1; url=kategori.php" />
                        <?php
                    } else {
                        $data = mysqli_query($koneksi, "select * from tabel_kategori where nama_kategori = '$kategori'");
                        $cek = mysqli_num_rows($data);
                        
                        if($cek > 0) {
                            ?>
                            <div class="alert alert-warning mt-3" role="alert">
                            Kategori Sudah Tersedia.
                            </div>
                            <?php
                        } else {
                            $simpan = mysqli_query($koneksi, "update tabel_kategori set nama_kategori = '$kategori' where kategori_id='$id'");

                            if($simpan){
                                ?>
                                <div class="alert alert-primary mt-3" role="alert">
                                    Kategori Berhasil Diupdate.
                                </div>
                                <meta http-equiv="refresh" content="1; url=kategori.php" />
                            <?php
                            }
                            else {
                                echo mysqli_error($koneksi);
                            }
                        }
                    }
                }

                if(isset($_POST['deleteBtn'])) {
                    // Memeriksa apakah ada produk terkait dengan kategori yang akan dihapus
                    $checkProducts = mysqli_query($koneksi, "SELECT * FROM tabel_produk WHERE kategori_id = '$id'");
                    
                    if(mysqli_num_rows($checkProducts) > 0) {
                        // Jika ada produk terkait, tampilkan pesan kesalahan
                        ?>
                        <div class="alert alert-danger mt-3" role="alert">
                            Gagal menghapus kategori. Dikarenakan Produk Tersedia.
                        </div>
                        <?php
                    } else {
                        // Jika tidak ada produk terkait, maka hapus kategori
                        $data = mysqli_query($koneksi, "DELETE FROM tabel_kategori WHERE kategori_id = '$id'");
                        
                        if($data) {
                            ?>
                            <div class="alert alert-primary mt-3" role="alert">
                                Kategori Berhasil Dihapus.
                            </div>
                            <meta http-equiv="refresh" content="1; url=kategori.php" />
                            <?php
                        } else {
                            ?>
                            <div class="alert alert-danger mt-3" role="alert">
                                Gagal menghapus kategori. Silakan coba lagi.
                            </div>
                            <?php
                        }
                    }
                }
            ?>
        </div>
    </div>
</body>
</html>