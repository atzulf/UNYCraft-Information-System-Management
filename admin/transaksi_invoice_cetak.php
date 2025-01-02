<?php include 'navbar1.php'; ?>

<div class="container mt-5">
    <div class="panel">
        <div class="panel-heading">
            <h4>Invoice Transaksi</h4>
        </div>
        <hr>
        <div class="panel-body">
            <?php
            // koneksi database
            include '../koneksi.php';

            // ambil id transaksi dari parameter URL
            $id_transaksi = $_GET['id'];

           // ambil data transaksi berdasarkan id dengan JOIN tabel_produk, tabel_transaksi, dan tabel_customer
           $data_transaksi = mysqli_query($koneksi, "SELECT * FROM tabel_produk
           INNER JOIN tabel_transaksi ON tabel_produk.produk_id = tabel_transaksi.harga_transaksi
           INNER JOIN tabel_customer ON tabel_transaksi.nama_pelanggan = tabel_customer.id_customer
           WHERE transaksi_id = '$id_transaksi'");
           $transaksi = mysqli_fetch_assoc($data_transaksi);
            ?>
            <table class="table table-bordered">
                <tr>
                    <th width="30%">Detail Transaksi:</th>
                    <td>INVOICE-<?php echo $transaksi['transaksi_id']; ?></td>
                </tr>
                <tr>
                    <th>Tanggal:</th>
                    <td><?php echo $transaksi['transaksi_tgl']; ?></td>
                </tr>
                <tr>
                    <th>Pelanggan:</th>
                    <td><?php echo $transaksi['nama_customer']; ?></td>
                </tr>
            </table>

            <table class="table table-bordered">
                <tr>
                    <th width="30%">Detail Produk:</th>
                    <td><?php echo $transaksi['nama_produk']; ?></td>
                </tr>
                <tr>
                    <th>Harga:</th>
                    <td>Rp. <?php echo number_format($transaksi['harga_produk']); ?></td>
                </tr>
                <tr>
                    <th>Jumlah:</th>
                    <td><?php echo $transaksi['jumlah_transaksi']; ?></td>
                </tr>
                <tr>
                    <th>Total Transaksi:</th>
                    <td>Rp. <?php echo number_format($transaksi['total_transaksi']); ?></td>
                </tr>
                <tr>
                <th>Status Transaksi:</th>
                <td>
            <?php
            $status_label = ($transaksi['transaksi_status'] == "0") ? 'label-warning' : 'label-info';
            $status_text = ($transaksi['transaksi_status'] == "0") ? 'TERSEDIA' : 'HABIS';
            echo "<div class='label $status_label'>$status_text</div>";
            ?>
            </td>
            </tr>
            </table>

            <hr>
            <p><center><i>" Terima kasih sudah membeli produk pada kami "</i></center></p>
        </div>
        <script type="text/javascript">
        window.print();
        </script>
    </div>
</div>