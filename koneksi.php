<?php
    $koneksi = mysqli_connect("localhost","root","","db_store");

    //memeriksa koneksi
    if (mysqli_connect_errno()){
        echo"Gagal koneksi Ke Databse: ".mysqli_connect_error();
    }
?>