<?php
include '../koneksi.php';

if(isset($_POST['nama']) && isset($_POST['hp']) && isset($_POST['alamat'])) {
    $nama = htmlspecialchars($_POST['nama']);
    $hp = htmlspecialchars($_POST['hp']);
    $alamat = htmlspecialchars($_POST['alamat']);

    // Memeriksa apakah data customer sudah ada berdasarkan nama atau nomor HP
    $cekData = mysqli_query($koneksi, "SELECT * FROM tabel_customer WHERE nama_customer = '$nama' OR no_tlp = '$hp'");
    
    if(mysqli_num_rows($cekData) > 0) {
        // Jika data sudah ada, tampilkan pesan kesalahan
        header("Location: customer_tambah.php?pesan=data_sama");
        exit(); // Hentikan eksekusi skrip
    } else {
        // Jika data belum ada, lanjutkan proses penambahan data
        $queryTambah = mysqli_query($koneksi, "INSERT INTO tabel_customer (nama_customer, no_tlp, alamat_customer) 
        VALUES ('$nama','$hp','$alamat')");
    
        if ($queryTambah) {
            // Redirect ke halaman customer_tambah.php dengan menyertakan parameter 'pesan'
            header("Location: customer_tambah.php?pesan=tambah_sukses");
            exit(); // Hentikan eksekusi skrip
        } else {
            echo mysqli_error($koneksi);
            exit(); // Hentikan eksekusi skrip
        }
    }
} else {
    // Jika tidak semua data terisi, kembali ke halaman customer_tambah.php
    header("Location: customer_tambah.php");
    exit(); // Hentikan eksekusi skrip
}
?>
