<?php 
    require "function/functions.php";

    $nomor_register = $_GET['nomor_register'];

    $query = "DELETE FROM pelaporan WHERE nomor_register = '$nomor_register'";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        header("Location: laporan.php?alert=3");
    }else{
        echo "Data Gagal dihapus!";
    }

    mysqli_close($koneksi);
?>