<?php 
session_start();
if($_SESSION['login'] == false) {
    header("Location: ../index.php?pesan=belum_login");  
}

include "../koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
    .no-decoration {
        text-decoration: none !important;
    }

    .chart-container {
        width: 50%;
        /* Atur ukuran lebar chart */
        height: auto;
        margin: 20px auto;
    }
    </style>
</head>

<body>
    <?php include 'navbar1.php'; ?>

    <div class="container mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="../admin/index1.php" class="no-decoration text-muted">
                        <i class="fa fa-home me-1"></i>Home
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <i class="fas fa-user-tag me-1"></i>Customer
                </li>
            </ol>
        </nav>

        <div class="panel">
            <div class="panel-heading">
                <h2>Data Customer</h2>
                <a href="customer_tambah.php" class="btn btn-sm btn-info pull-right">Tambah</a>
            </div>

            <?php if(isset($_GET['pesan']) && $_GET['pesan'] == 'hapus_sukses') { ?>
            <div class="alert alert-primary mt-3" role="alert">
                Data Customer berhasil dihapus.
            </div>
            <meta http-equiv="refresh" content="1; url=customer.php" />
            <?php } ?>

            <br><br>

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th width="1%">No</th>
                        <th>Nama</th>
                        <th>HP</th>
                        <th>Alamat</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = mysqli_query($koneksi, "SELECT * FROM tabel_customer ORDER BY id_customer ASC");
                    $no = 1;
                    while ($d = mysqli_fetch_array($query)) {
                        echo "<tr>
                            <td>" . $no++ . "</td>
                            <td>" . htmlspecialchars($d['nama_customer']) . "</td>
                            <td>" . htmlspecialchars($d['no_tlp']) . "</td>
                            <td>" . htmlspecialchars($d['alamat_customer']) . "</td>
                            <td>
                                <a href='customer_edit.php?id=" . $d['id_customer'] . "' class='btn btn-sm btn-warning'>
                                    <i class='fas fa-cogs me-1'></i>Edit
                                </a>
                                <a href='customer_hapus.php?id=" . $d['id_customer'] . "' class='btn btn-sm btn-danger'>
                                    <i class='fas fa-trash me-1'></i>Hapus
                                </a>
                            </td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <div class="chart-container">
            <canvas id="customerChart"></canvas>
        </div>
    </div>

    <script>
    const ctx = document.getElementById('customerChart').getContext('2d');
    const customerData = {
        labels: [<?php
                $chartQuery = mysqli_query($koneksi, "SELECT alamat_customer, COUNT(*) AS jumlah FROM tabel_customer GROUP BY alamat_customer");
                $labels = [];
                while ($row = mysqli_fetch_assoc($chartQuery)) {
                    $labels[] = "'" . $row['alamat_customer'] . "'";
                }
                echo implode(',', $labels);
            ?>],
        datasets: [{
            label: 'Jumlah Customer',
            data: [<?php
                    mysqli_data_seek($chartQuery, 0);
                    $data = [];
                    while ($row = mysqli_fetch_assoc($chartQuery)) {
                        $data[] = $row['jumlah'];
                    }
                    echo implode(',', $data);
                ?>],
            backgroundColor: ['rgba(54, 162, 235, 0.5)', 'rgba(255, 99, 132, 0.5)',
                'rgba(75, 192, 192, 0.5)'
            ],
            borderColor: ['rgba(54, 162, 235, 1)', 'rgba(255, 99, 132, 1)', 'rgba(75, 192, 192, 1)'],
            borderWidth: 1
        }]
    };

    const customerChart = new Chart(ctx, {
        type: 'pie',
        data: customerData,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top'
                },
                title: {
                    display: true,
                    text: 'Distribusi Jumlah Customer per Wilayah'
                }
            }
        }
    });
    </script>
</body>

</html>