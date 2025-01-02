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
    <title>Website UNY Craft</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
    <script type="text/javascript" src="../assets/js/jquery.js"></script>
    <script type="text/javascript" src="../assets/js/bootstrap.js"></script>
</head>

<body>

    <div class="container">
        <center>
            <h2>UNYCraft </h2>
        </center>
        <br /><br />
        <?php
        if(isset($_GET['dari']) && isset($_GET['sampai'])){
            $dari = $_GET['dari'];
            $sampai = $_GET['sampai'];
            ?>
        <h4>Data Laporan UNYCraft dari <b><?php echo $dari; ?></b> sampai <b><?php echo $sampai; ?></b></h4>
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
                    $data = mysqli_query($koneksi, "SELECT * FROM tabel_produk
                          INNER JOIN tabel_transaksi ON tabel_produk.produk_id = tabel_transaksi.harga_transaksi
                          INNER JOIN tabel_customer ON tabel_transaksi.nama_pelanggan = tabel_customer.id_customer
                          WHERE nama_pelanggan=id_customer AND DATE(transaksi_tgl) > '$dari' AND DATE(transaksi_tgl)< '$sampai'
                          ORDER BY tabel_transaksi.transaksi_id DESC");
                    $no = 1;

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
                                    echo "<div class='label label-success'>TERSEDIA</div>"; 
                                } else if($d['transaksi_status'] == "1") { 
                                    echo "<div class='label label-warning'>HABIS</div>";
                                } 
                                ?>
                </td>
            </tr>
            <?php } ?>
        </table>
        <?php } ?>
    </div>

    <script type="text/javascript">
    window.print();
    </script>
</body>

</html>