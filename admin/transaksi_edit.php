<?php
// koneksi database
include '../koneksi.php';

// ambil id transaksi dari parameter URL
$id_transaksi = $_GET['id'];

// ambil data transaksi berdasarkan id
$data_transaksi = mysqli_query($koneksi, "SELECT * FROM tabel_transaksi WHERE transaksi_id = '$id_transaksi'");
$d = mysqli_fetch_array($data_transaksi);

//ambil data customer dari database
$data_customer = mysqli_query($koneksi, "SELECT * FROM tabel_customer");

// ambil data produk dari database
$data_produk = mysqli_query($koneksi, "SELECT * FROM tabel_produk");
?>
<?php include 'navbar1.php'; ?>

<div class="container mt-5">
    <div class="panel">
        <div class="panel-heading">
            <h4>Edit Data Transaksi</h4>
        </div>

        <div class="panel-body">

            <div class="col-md-8 col-md-offset-2">
                <a href="transaksi.php" class="btn btn-sm btn-info pull-right">Kembali</a>
                <br/>
                <br/>
                <form method="post" action="transaksi_update.php">
                    <input type="hidden" name="id_transaksi" value="<?php echo $d['transaksi_id']; ?>">

                    <div class="form-group">
                        <label>Harga</label>
                        <select class="form-control" name="Harga" required="required">
                            <option value="">- Pilih Harga</option>
                            <?php
                            while ($produk = mysqli_fetch_array($data_produk)) {
                                $selected = ($produk['produk_id'] == $d['harga_transaksi']) ? 'selected' : '';
                            ?>
                                <option value="<?php echo $produk['produk_id']; ?>" <?php echo $selected; ?>><?php echo $produk['harga_produk']; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Produk</label>
                        <select class="form-control" name="produk" required="required">
                            <option value="">- Pilih Produk</option>
                            <?php
                            $data_produk = mysqli_query($koneksi, "select * from tabel_produk");
                            while ($produk = mysqli_fetch_array($data_produk)) {
                                $selected = ($produk['produk_id'] == $d['harga_transaksi']) ? 'selected' : '';
                            ?>
                                <option value="<?php echo $produk['produk_id']; ?>" <?php echo $selected; ?>><?php echo $produk['nama_produk']; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                        </div>
                        <div class="form-group">
                        <label>Pelanggan</label>
                        <select class="form-control" name="pelanggan" required="required">
                            <option value="">- Pilih Pelanggan</option>
                            <?php
                            while ($customer = mysqli_fetch_array($data_customer)) {
                                $selected = ($customer['id_customer'] == $d['nama_pelanggan']) ? 'selected' : '';
                            ?>
                                <option value="<?php echo $customer['id_customer']; ?>" <?php echo $selected; ?>><?php echo $customer['nama_customer']; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Jumlah Beli</label>
                        <input type="number" class="form-control" name="jumlah" value="<?php echo $d['jumlah_transaksi']; ?>" placeholder="Masukkan jumlah beli." required="required">
                    </div>
                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type="date" class="form-control" name="tanggal" value="<?php echo $d['transaksi_tgl']; ?>" required="required">
                    </div>

                    <br />

                    <input type="submit" class="btn btn-primary" value="Simpan">
                </form>
            </div>
        </div>
    </div>
</div>
