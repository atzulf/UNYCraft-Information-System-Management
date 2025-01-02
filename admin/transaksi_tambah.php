<?php 
session_start();
if($_SESSION['login']==false){
    header("Location: ../index.php?pesan=belum_login");  
}
include 'navbar1.php';
include '../koneksi.php';
?>

<div class="container"> 
    <div class="panel">
        <div class="panel-heading">
            <h4>Transaksi Baru</h4>
        </div>
    
        <div class="panel-body">
            
            <div class="col-md-8 col-md-offset-2">
                <a href="transaksi.php" class="btn btn-sm btn-info pull-right">Kembali</a>
            <br/>
            <br/>
                <form method="post" action="transaksi_aksi.php">
                    <div class="form-group">
                        <label>Harga</label>
                        <select class="form-control" name="Harga" required="required">
                            <option value="">- Pilih Harga</option>
                            <?php
                            // mengambil data pelanggan dari database 
                            $data = mysqli_query($koneksi, "select * from tabel_produk");
                            // mengubah data ke array dan menampilkannya dengan perulangan while
                            while($d=mysqli_fetch_array($data)){
                            ?>
                            <option value="<?php echo $d['produk_id']; ?>"><?php echo $d['harga_produk']; ?></option>                    
                            <?php
                            } 
                            ?>
                        </select>

                        <label>Produk</label>
                        <select class="form-control" name="produk" required="required">
                            <option value="">- Pilih Produk</option>
                            <?php
                            // mengambil data pelanggan dari database 
                            $data = mysqli_query($koneksi, "select * from tabel_produk");
                            // mengubah data ke array dan menampilkannya dengan perulangan while
                            while($d=mysqli_fetch_array($data)){
                            ?>
                            <option value="<?php echo $d['produk_id']; ?>"><?php echo $d['nama_produk']; ?></option>                    
                            <?php
                            } 
                            ?>
                        </select>
                    
                        <label>Pelanggan</label>
                        <select class="form-control" name="pelanggan" required="required">
                            <option value="">- Pilih Pelanggan</option>
                            <?php
                            // mengambil data pelanggan dari database 
                            $data = mysqli_query($koneksi, "select * from tabel_customer");
                            // mengubah data ke array dan menampilkannya dengan perulangan while
                            while($d=mysqli_fetch_array($data)){
                            ?>
                            <option value="<?php echo $d['id_customer']; ?>"><?php echo $d['nama_customer']; ?></option>                    
                            <?php
                            } 
                            ?>
                        </select>
                    </div>

                    <div class="form-group"> 
                        <label>Jumlah Beli</label> 
                        <input type="number" class="form-control" name="jumlah" placeholder="Masukkan jumlah beli." required="required">
                    </div>
                    <div class="form-group">
                        <label>Tanggal</label> 
                        <input type="date" class="form-control" name="tanggal" required="required">
                    </div>

                    <br/>

                    <input type="submit" class="btn btn-primary" value="Simpan">
                </form>
            </div>
        </div>
    </div>
</div>

