<?php include 'navbar1.php'; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Customer</h3>
                </div>
                <div class="card-body">
                    <?php
                    include '../koneksi.php';

                    // Cek apakah ada pesan yang dilewatkan melalui URL
                    if(isset($_GET['pesan'])){
                        if($_GET['pesan'] == 'update_sukses'){
                            // Menampilkan alert ketika pembaruan data berhasil
                            ?><div class="alert alert-success" role="alert">
                            Data customer berhasil diperbarui.
                            </div>
                            <meta http-equiv="refresh" content="1; url=customer.php" />
                            <?php
                        }
                    }

                    $id = $_GET['id'];
                    $data = mysqli_query($koneksi, "SELECT * FROM tabel_customer WHERE id_customer = '$id'");
                    while($d=mysqli_fetch_array($data)){?>
                    <form action="customer_update.php" method="post">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="hidden" name="id" value="<?php echo $d['id_customer']; ?>"> 
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama .." value="<?php echo $d['nama_customer']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="hp" class="form-label">HP</label>
                            <input type="number" class="form-control" id="hp" name="hp" placeholder="Masukkan nomor HP .." value="<?php echo $d['no_tlp']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukkan alamat .." value="<?php echo $d['alamat_customer']; ?>">
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
