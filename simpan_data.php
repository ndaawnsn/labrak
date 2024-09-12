<?php
include 'function/functions.php';
if(isset($_GET['noreg'])){
    $noreg=$_GET['noreg'];
    $status=$_POST['status'];

    $query=mysqli_query($koneksi,"UPDATE pelaporan SET status='$status' WHERE nomor_register='$noreg'");

    if($query){
        header("Location: laporan.php?alert=1");

    } 
}
?>