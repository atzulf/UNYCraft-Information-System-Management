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
    <title>Transaksi</title>
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
                    <i class="fas fa-shopping-cart me-1"></i>Transaksi
                </li>
            </ol>
        </nav>
        <div class="panel">
            <div class="panel-heading">
                <h4>Data Transaksi Produk</h4>
            </div>
            <div class="panel-body">

                <a href="transaksi_tambah.php" class="btn btn-sm btn-info pull-right">Transaksi Baru</a>

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
                        <th width="23%">OPSI</th>
                    </tr>

                    <?php
                // koneksi database
                include '../koneksi.php';

                // mengambil data transaksi dari database dengan JOIN tabel_produk dan tabel_transaksi
                $data = mysqli_query($koneksi, "SELECT * FROM tabel_produk
                        INNER JOIN tabel_transaksi ON tabel_produk.produk_id = tabel_transaksi.harga_transaksi
                        INNER JOIN tabel_customer ON tabel_transaksi.nama_pelanggan = tabel_customer.id_customer
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
                        <td>
                            <a href="transaksi_invoice.php?id=<?php echo $d['transaksi_id']; ?>" target="_blank"
                                class="btn btn-sm btn-info"><i class="fas fa-file-invoice me-1"></i>Invoice
                            </a>
                            <a href="transaksi_edit.php?id=<?php echo $d['transaksi_id']; ?>"
                                class="btn btn-sm btn-warning"><i class="fas fa-cogs me-1"></i>Edit
                            </a>
                            <a href="transaksi_hapus.php?id=<?php echo $d['transaksi_id']; ?>"
                                class="btn btn-sm btn-danger"><i class="fas fa-times me-1"></i>Batalkan
                            </a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
</body>

</html>