<?php 
    session_start();
    require "function/functions.php";
    
   // Query to retrieve count of data
    $total = "SELECT COUNT(*) as total_data FROM pelaporan";
    $result = mysqli_query($koneksi, $total);

    // Fetch result
    $row = mysqli_fetch_assoc($result);
    $total_data = $row['total_data'];

    // Data Selesai Grafik
    $selesai = "SELECT COUNT(*) as data_selesai FROM pelaporan WHERE status='selesai' ";
    $result = mysqli_query($koneksi, $selesai);

    $row = mysqli_fetch_assoc($result);
    $data_selesai = $row['data_selesai'];

    // Data Belum Selesai
    $belum_selesai = "SELECT COUNT(*) as data_belum_selesai FROM pelaporan WHERE status='Menunggu Konfirmasi'";
    $result = mysqli_query($koneksi, $belum_selesai);

    $row = mysqli_fetch_assoc($result);
    $data_belum_selesai = $row['data_belum_selesai'];
    

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="img/logoIcon.png">
    <title>LABRRAK - Dashboard</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/"
        crossorigin="anonymous">
    <link rel="stylesheet" href="css/styler.css?v=1.0">
    <link rel="stylesheet" href="css/dashboard.css?v=1.0">
    <script src="js/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <script src="js/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>

    <style>
    
.rentang {
    padding-bottom: 75px;
}
@media screen and (max-width:426px) {
    .jumlah-data{
        flex-direction:column !important;
    }
    
}
@media screen and (max-width:768px) {
    .card{
        width: 180px !important;
    }
}

    </style>
</head>

<body>
    <div class="header">
        <div class="tittle">
            <img src="img/logoIcon.png" width="30px" height="30px" class="float-left logo-fav">
            <h3 class="text-secondary font-weight-bold float-left logo">LABRRAK</h3>
        </div>
        <a href="logout.php">
            <div class="logout">
                <i class="fas fa-sign-out-alt float-right log"></i>
                <p class="float-right logout">Logout</p>
            </div>
        </a>
    </div>

    <div class="sidebar">
        <nav>
            <ul>
                <li class="rentang">
                    <img src="img/user.png" class="img-fluid profile float-left" width="60px">
                    <h5 class="admin"><?php echo $_SESSION['username']?></h5>
                    <div class="online online2">
                        <p class="float-right ontext">Online</p>
                        <div class="on float-right"></div>
                    </div>
                </li>
                <!-- fungsi slide -->
                <script>
                    $(document).ready(function () {
                        $("#flip").click(function () {
                            $("#panel").slideToggle("medium");
                            $("#panel2").slideToggle("medium");
                        });
                        $("#flip2").click(function () {
                            $("#panel3").slideToggle("medium");
                            $("#panel4").slideToggle("medium");
                        });
                    });
                </script>
                <!-- dashboard -->
                <a href="dashboard.php" style="text-decoration: none;">
                    <li class="aktif" style="border-left: 5px solid #306bff;">
                        <div>
                            <span class="fas fa-tachometer-alt"></span>
                            <span>Dashboard</span>
                        </div>
                    </li>
                </a>

               
               

                <!-- laporan -->
                <a href="laporan.php" style="text-decoration: none;">
                    <li>
                        <div>
                            <span><i class="fas fa-clipboard-list"></i></span>
                            <span>Laporan</span>
                        </div>
                    </li>
                </a>

                <!-- change icon -->
                <script>
                    $(".klik").click(function () {
                        $(this).find('i').toggleClass('fa-caret-up fa-caret-right');
                        if ($(".klik").not(this).find("i").hasClass("fa-caret-right")) {
                            $(".klik").not(this).find("i").toggleClass('fa-caret-up fa-caret-right');
                        }
                    });
                    $(".klik2").click(function () {
                        $(this).find('i').toggleClass('fa-caret-up fa-caret-right');
                        if ($(".klik2").not(this).find("i").hasClass("fa-caret-right")) {
                            $(".klik2").not(this).find("i").toggleClass('fa-caret-up fa-caret-right');
                        }
                    });
                </script>
                <!-- change icon -->
            </ul>
        </nav>
    </div>

    <div class="main-content khusus">
        <div class="konten khusus2">
            <div class="konten_dalem khusus3">
                <h2 class="heade" style="color: #4b4f58;">Dashboard</h2>
                <hr style="margin-top: -2px;">
                <div class="container d-flex justify-content-around" id="container" style="border: none;">

                <div class="d-flex justify-content-between w-100 jumlah-data">

                       <!-- JUMLAH TOTAL DATA -->
                        <div class="card mb-3 bg-primary pl-4" style="width: 300px;">
                            <div class="row g-0">
                                <div class="icon-big text-center ms-5">
                                    <i class="fas fa-file ikon"></i>
                                </div>
                                    <div class="col-md-8">
                                        <div class="col-7 d-flex align-items-center tulisan">
                                            <div class="numbers">
                                                <p class="card-category ket head " style="font-weight:bold;">Laporan Masuk</p>
                                                <h3 class="card-title ket total"><?= $total_data;?> Laporan</h3>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>

                        <!-- JUMLAH DATA SELESAI -->
                        <div class="card mb-3 bg-primary pl-4" style="width: 300px;">
                            <div class="row g-0">
                                <div class="icon-big text-center ms-5">
                                    <i class="	fas fa-tasks ikon"></i>
                                </div>
                                    <div class="col-md-8">
                                        <div class="col-7 d-flex align-items-center tulisan">
                                            <div class="numbers">
                                                <p class="card-category ket head " style="font-weight:bold;">Laporan Selesai</p>
                                                <h3 class="card-title ket total"><?= $data_selesai;?> Laporan</h3>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>

                        <!-- JUMLAH DATA BELUM SELESAI -->
                        <div class="card mb-3 bg-primary pl-4" style="width: 300px;">
                            <div class="row g-0">
                                <div class="icon-big text-center ms-5">
                                <i class="	fas fa-clock ikon"></i>
                                </div>
                                    <div class="col-md-8">
                                        <div class="col-7 d-flex align-items-center tulisan">
                                            <div class="numbers">
                                                <p class="card-category ket head " style="font-weight:bold;">Laporan Belum Selesai</p>
                                                <h3 class="card-title ket total"><?= $data_belum_selesai;?> Laporan</h3>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                </div>

            </div>
        </div>
    </div>

    <input type="hidden" id="username" value="<?= $ambilNama ?>">
    <input type="hidden" id="saldoRekening" value="<?= $saldoRek ?>">

   

    <script src="js/bootstrap.js"></script>
    <script src="js/kirimNoRek.js"></script>
    <script src="ajax/js/tambahRekeningIn.js"></script>
    <script src="ajax/js/tambahRekeningOut.js"></script>
</body>

</html>