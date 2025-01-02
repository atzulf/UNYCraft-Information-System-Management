<?php
include '../koneksi.php';

$id = $_POST['id'];
$nama = $_POST['nama'];
$hp = $_POST['hp'];
$alamat = $_POST['alamat'];

$queryUpdate = mysqli_query($koneksi, "UPDATE tabel_customer SET nama_customer = '$nama', no_tlp = '$hp', alamat_customer = '$alamat' WHERE id_customer = '$id'");

if ($queryUpdate) {
    // Redirect ke halaman customer_edit.php dengan menyertakan parameter 'pesan'
    header("Location: customer_edit.php?id=$id&pesan=update_sukses");
    exit(); // Penting: pastikan kode berhenti di sini setelah mengarahkan pengguna
} else {
    echo mysqli_error($koneksi);
}
?>
