<?php include 'navbar1.php'; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tambah Customer Baru</h3>
                </div>
                <div class="card-body">
                    <!-- Menampilkan pesan kesalahan jika terdapat kesamaan data -->
                    <?php if(isset($_GET['pesan']) && $_GET['pesan'] == 'data_sama'): ?>
                        <div class="alert alert-danger" role="alert">
                            Terdapat kesamaan data. Mohon periksa kembali nama atau nomor HP yang dimasukkan.
                        </div>
                    <?php endif; ?>
                    <!-- Menampilkan pesan sukses jika data berhasil disimpan -->
                    <?php if(isset($_GET['pesan']) && $_GET['pesan'] == 'tambah_sukses'): ?>
                        <div class="alert alert-success" role="alert">
                            Data customer berhasil disimpan.
                        </div>
                        <meta http-equiv="refresh" content="2; url=customer.php" />
                    <?php endif; ?>
                    <!-- Form untuk input data customer -->
                    <form action="customer_aksi.php" method="post">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama ..">
                        </div>
                        <div class="mb-3">
                            <label for="hp" class="form-label">HP</label>
                            <input type="number" class="form-control" id="hp" name="hp" placeholder="Masukkan nomor HP ..">
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukkan alamat ..">
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
