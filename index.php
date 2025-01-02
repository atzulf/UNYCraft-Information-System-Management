<?php include 'koneksi.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
    body {
        background: url('./image/mockup.jpg') center center no-repeat;
        background-size: cover;
        /* Tambahkan warna background sesuai kebutuhan jika gambar tidak tampil */
    }

    .main {
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .login-box {
        max-width: 500px;
        width: 100%;
        padding: 20px;
        box-sizing: border-box;
        border-radius: 10px;
        background-color: rgba(255, 255, 255, 0.8);
        /* Tambahkan warna background dengan transparansi */
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    </style>
</head>

<body>
    <div class="main">
        <div class="login-box">
            <h3 class="mb-3 text-center">Login UNY Craft</h3>
            <form action="login.php" method="post">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" name="username" id="username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="password" required>
                </div>
                <div>
                    <button class="btn btn-success form-control mb-3" type="submit" name="loginbtn">Login</button>
                </div>
            </form>
            <?php
            if (isset($_GET['pesan'])) {
                if ($_GET['pesan'] == "gagal") {
                    echo "<div class='alert alert-danger text-center'> Login Gagal! Username dan Password salah </div>";
                } else if ($_GET['pesan'] == "logout") {
                    echo "<div class='alert alert-info text-center'> Anda telah Berhasil Logout </div>";
                } else if ($_GET['pesan'] == "belum_login") {
                    echo "<div class='alert alert-warning text-center'>Anda Tidak Memiliki Akun!</div>";
                }
            }
            ?>
        </div>
    </div>
</body>

</html>