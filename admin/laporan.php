<?php 
session_start();
if($_SESSION['login']==false){
    header("Location: ../index.php?pesan=belum_login");  
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan</title>
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
                    <i class="fas fa-file-invoice me-1"></i>Laporan
                </li>
            </ol>
        </nav>
        <div class="panel">
            <div class="panel-heading">
                <h4>Filter Laporan</h4>
            </div>
            <br>
            <div class="panel-body">

                <form action="" method="get">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>Dari Tanggal</th>
                            <th>Sampai Tanggal</th>
                            <th width="1%"></th>
                        </tr>
                        <tr>
                            <td>
                                <br />
                                <input type="date" name="tgl_dari" class="form-control">
                            </td>
                            <td>
                                <br />
                                <input type="date" name="tgl_sampai" class="form-control">
                            </td>
                            <td>
                                <br />
                                <input type="submit" class="btn btn-primary" value="Filter">
                            </td>
                        </tr>

                    </table>
                </form>
            </div>
        </div>
    </div>
    <br />
    <?php
if(isset($_GET['tgl_dari']) && isset($_GET['tgl_sampai'])){
    $dari = $_GET['tgl_dari'];
    $sampai = $_GET['tgl_sampai'];

    ?>
    <div class="container mt-5">
        <div class="panel">
            <div class="panel-heading">
                <h4>Data Laporan UNYCraft dari <b><?php echo $dari; ?></b> sampai <b><?php echo $sampai; ?></b></h4>
            </div>
            <div class="panel-body">

                <a target="_blank" href="cetak_print.php?dari=<?php echo $dari; ?>&sampai=<?php echo $sampai; ?>"
                    class="btn btn-sm btn-primary"><i class="fas fa-print"></i> CETAK</a>
                <br />
                <br />
                <table class="table table-bordered table-striped">
                    <tr>
                        <th width="1%">No</th>
                        <th>Invoice</th>
                        <th>Tanggal</th>
                        <th>Customer</th>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Total Transaksi</th>
                        <th>Status</th>
                    </tr>

                    <?php
                // koneksi database
                include '../koneksi.php';

                // mengambil data transaksi dari database dengan JOIN tabel_produk dan tabel_transaksi
                $data = mysqli_query($koneksi, "SELECT * FROM tabel_produk
                          INNER JOIN tabel_transaksi ON tabel_produk.produk_id = tabel_transaksi.harga_transaksi
                          INNER JOIN tabel_customer ON tabel_transaksi.nama_pelanggan = tabel_customer.id_customer
                          WHERE nama_pelanggan=id_customer AND DATE(transaksi_tgl) > '$dari' AND DATE(transaksi_tgl)< '$sampai'
                          ORDER BY tabel_transaksi.transaksi_id DESC");
                $no = 1;


                // mengubah data ke array dan menampilkannya dengan perulangan while
                while($d=mysqli_fetch_array($data)){ ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td>INVOICE-<?php echo $d['transaksi_id']; ?></td>
                        <td><?php echo $d['transaksi_tgl']; ?></td>
                        <td><?php echo $d['nama_customer']; ?></td>
                        <td><?php echo $d['nama_produk']; ?></td>
                        <td><?php echo "Rp. ".number_format($d['harga_produk']).",00"; ?></td>
                        <td><?php echo $d['jumlah_transaksi']; ?></td>
                        <td><?php echo "Rp. ".number_format($d['total_transaksi']).",00"; ?></td>
                        <td>
                            <?php
                            if ($d['transaksi_status'] == "0") {
                                echo "<div class='label label-warning'>TERSEDIA</div>"; 
                            } else if($d['transaksi_status'] == "1") { 
                                echo "<div class='label label-info'>HABIS</div>";
                            } 
                            ?>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
    <?php } ?>
</body>

</html>