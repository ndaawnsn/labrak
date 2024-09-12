<?php 
    session_start();
    require "function/functions.php";

    if(isset($_GET['alert'])){
        if($_GET['alert']==1){
            echo '<script>alert("Data Berhasil Diubah.")</script>';
        }elseif($_GET['alert']==2){
            echo '<script>alert("Data Gagal Diubah.")</script>';
        }elseif($_GET['alert']==3){
            echo '<script>alert("Data Berhasil Dihapus.")</script>';
        }else{
            echo '<script>alert("Data Gagal Dihapus.")</script>';
        }
    }
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="img/logoIcon.png">
    <title>LABRRAK - Laporan</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/"
        crossorigin="anonymous">
    <link rel="stylesheet" href="css/styler.css?v=1.0">
    <link rel="stylesheet" href="css/dashboard.css?v=1.0">
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/sweetalert.min.js"></script>
    <script src="js/chart.js"></script>

    <!--  -->
    <style>
    * {
        font-family: 'Calibri';
    }

    body {
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: auto;
        margin: 50px;
        padding: 20px;
        background-color: #D9D9D9;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
    }

    .header {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
    }

    .title {
        font-size: 30px;
        font-weight: bold;
    }

    .button-search {
        display: inline-block;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        margin-right: 10px;
        float: left;
        background-color: #008CBA;
        color: white;
    }

    .button {
        display: inline-block;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        margin-right: 10px;
    }

    .button-search:hover {
        background-color: #00698C;
    }

    .button:hover {
        background-color: #00698C;
    }

    .search {
        float: left;
        background-color: #008CBA;
        color: white;
        background: #fff;
        height: 32px;
        width: 250px;
        margin-right: 5px;
        border-radius: 5px;
        color: #000;
    }

    .add {
        float: right;
        background-color: #087CFC;
        color: white;
    }

    table {
        border-collapse: collapse;
        width: 100%;

    }

    th,
    td {
        text-align: center;
        padding: 8px;
    }

    td {
        font-size: 20px;
    }

    th {
        background-color: #343A40;
        color: white;
        font-size: 22px;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    .action {
        display: flex;
        justify-content: center;
    }

    .action a {
        background-color: #008CBA;
        color: white;
        border: none;
        border-radius: 5px;
        padding: 5px 10px;
        margin-right: 5px;
        cursor: pointer;
    }

    .action a:hover {
        background-color: #00698C;
    }

    .popup {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.4);
    }

    .popup-content {
        background-color: white;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 50%;
        max-width: 600px;
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    .tabels {
        max-height: 300px;
        overflow-y: auto;
        margin-top: 10px;
    }

    @media (max-width: 500px) {
        .container {
            width: 90%;
            margin: 0px;
            background-color: #000FF;
            ;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
            margin-top: 10px;
        }

        .search {
            float: left;
            background-color: #008CBA;
            color: white;
            background: #fff;
            height: 27px;
            width: 100px;
            margin-right: 5px;
            border-radius: 5px;
            color: #000;
        }

        table {
            border-collapse: collapse;
            margin-top: 20px;
        }

        td {
            font-size: 9px;
        }

        th {

            font-size: 9px;
        }

        .title {
            font-size: 15px;
            font-weight: bold;
        }
    }

    @media screen (max-width:425px) {
        
    }
    </style>
</head>

<body>
    <div class="header">
        <img src="img/logoIcon.png" width="30px" height="30px" class="float-left logo-fav">
        <h3 class="text-secondary font-weight-bold float-left logo pt-3">LABRRAK</h3>
    </div>

    <div class="sidebar">
        <nav>
            <ul>
                <li>
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
                    <li>
                        <div>
                            <span class="fas fa-tachometer-alt"></span>
                            <span>Dashboard</span>
                        </div>
                    </li>
                </a>
                            
                <!-- laporan -->
                <a href="laporan.php" style="text-decoration: none;">
                    <li class="aktif" style="border-left: 5px solid #306bff;">
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
                <h2 class="heade" style="color: #4b4f58;">Laporan</h2>
                <input type="hidden" id="username" value="<?= $ambilNama ?>">
                <hr style="margin-top: -2px;">
               
                <?php
                // proses pencarian
                $search_keyword = isset($_GET['search_keyword']) ? $_GET['search_keyword'] : '';
                $where_clause = "";
                if (!empty($search_keyword)) {
                    $where_clause = "WHERE nomor_register LIKE '%$search_keyword%' OR nama_pelapor LIKE '%$search_keyword%' OR nama_korban LIKE '%$search_keyword%'";
                }
                ?>
                
                <form method="GET">
                <input class="search" type="text" name="search_keyword" placeholder="Cari...">
                <button class="button-search" type="submit"><i class="fa fa-search"></i></button>
                <br><br>
                </form>
                        
                <?php
                
                $query=mysqli_query($koneksi,"SELECT * FROM pelaporan $where_clause ORDER BY status ASC, tanggal ASC");
                // $query=mysqli_query($mysqli,"SELECT * FROM data_login WHERE jabatan='Mahasiswa'");
                ?>
                    <div class="tabels">
                        <table border="1">
                            <thead>
                                <tr>
                                    <th>No. Register</th>
                                    <th>Tanggal</th>
                                    <th>Nama Pelapor</th>
                                    <th>Nama Korban</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $row=mysqli_num_rows($query);
                            $copy=$row;
                            while($row>0){
                                if($row>0){
                                    $data=mysqli_fetch_assoc($query);
                            ?>
                                <tr>
                                    <td><?php echo $data['nomor_register']; ?></td>
                                    <td><?php echo $data['tanggal']; ?></td>
                                    <td><?php echo $data['nama_pelapor']; ?></td>
                                    <td><?php echo $data['nama_korban']; ?></td>
                                    <td><?php echo $data['status']; ?></td>
                                    <td class="action">
                                            <?php
                                        if($data['status']=="Menunggu Konfirmasi"){
                                            ?>
                                           <?php 
                                        }
                                        ?>
                                            <a
                                                href="lihat_detail_data.php?noreg=<?php echo $data['nomor_register'] ?>&lihat">Lihat</a>   
                                            <a 
                                                href="hapus_data.php?nomor_register=<?php echo $data['nomor_register'] ?>&hapus"><i class="fa fa-trash"></i> Hapus</a>
                                            </td>
                                </tr>
                                <tr>
                            <?php
                                $row--;
                                }
                            }
                            if($copy<=0){
                                ?>
                                
                                <tr>
                                    <td colspan="4">Data Tidak Ditemukan.</td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>		
                </div>	

            </div>
        </div>
    </div>

    <script src="ajax/js/laporan.js"></script>
    <script src="js/bootstrap.js"></script>
</body>

</html>