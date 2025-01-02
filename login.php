<?php
session_start();
include 'koneksi.php';

$username = $_POST['username'];
$password = md5($_POST['password']);

$data = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$username' AND password='$password'");
$cek = mysqli_num_rows($data);

if ($cek > 0) {
    $user = mysqli_fetch_assoc($data);
    $_SESSION['username'] = $username;
    $_SESSION['role'] = $user['role'];

    if ($_SESSION['role'] == 'admin') {
        $_SESSION['login'] = true;
        header('location: admin/index1.php');
    } else if ($_SESSION['role'] == 'user') {
        $_SESSION['login'] = true;
        header('location: user/');
    }
} else {
    header('location: index.php?pesan=gagal');
    exit();
}
?>
