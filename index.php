<?php 
    session_start();
    require "function/functions.php";
    
    // Redirect if already logged in
    if ( isset($_SESSION["login"]) ) {
        header("Location: dashboard");
        exit;
    } elseif(isset($_COOKIE['login'])) {
        header("Location: dashboard");
        exit;
    }

    // Fetch last register number
    $statement = $koneksi->query("SELECT nomor_register FROM pelaporan ORDER BY nomor_register DESC LIMIT 1");
    if ($statement->num_rows > 0) {
        $nomor_register = $statement->fetch_assoc()['nomor_register'];
        $date_part = substr($nomor_register, 0, 6); // extract date part
        $seq_num = substr($nomor_register, 6); // extract sequence number
        $new_seq_num = str_pad(intval($seq_num) + 1, 3, '0', STR_PAD_LEFT);
        $kode = $date_part . $new_seq_num;
    } else {
        $kode = date('dmY') . '001';
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Validasi NIK, harus 16 digit
        if (!preg_match("/^\d{16}$/", $_POST['nik'])) {
            $error = "NIK harus terdiri dari 16 digit angka.";
        }
        // Validasi Nomor Telepon Pelapor, harus 10-15 digit
        elseif (!preg_match("/^\d{10,15}$/", $_POST['nomor_pelapor'])) {
            $error = "Nomor telepon pelapor harus terdiri dari 10 hingga 15 digit angka.";
        }
        // Validasi Nomor Telepon Korban, jika ada, harus 10-15 digit
        elseif (!empty($_POST['nomor_korban']) && !preg_match("/^\d{10,15}$/", $_POST['nomor_korban'])) {
            $error = "Nomor telepon korban harus terdiri dari 10 hingga 15 digit angka.";
        }
        // Validasi Nama, hanya boleh berisi huruf dan spasi
        elseif (!preg_match("/^[a-zA-Z\s]*$/", $_POST['nama_pelapor'])) {
            $error = "Nama pelapor hanya boleh berisi huruf dan spasi.";
        }
        // Validasi Alamat, tidak boleh kosong
        elseif (empty($_POST['alamat_pelapor'])) {
            $error = "Alamat pelapor tidak boleh kosong.";
        }
        // Validasi Jenis Kelamin, harus dipilih salah satu
        elseif (empty($_POST['jk_korban'])) {
            $error = "Jenis kelamin korban harus dipilih.";
        }
        // Validasi Pekerjaan Pelapor, tidak boleh kosong
        elseif (empty($_POST['pekerjaan_pelapor'])) {
            $error = "Pekerjaan pelapor tidak boleh kosong.";
        }
        // Validasi Kronologi, minimal 20 karakter
        elseif (strlen($_POST['kronologi']) < 20) {
            $error = "Kronologi harus terdiri dari minimal 20 karakter.";
        }
        // Jika semua validasi lolos, simpan ke database
        else {
            // Query untuk menyimpan data ke database
            $query = "INSERT INTO pelaporan (nomor_register, tanggal, nik, nama_pelapor, alamat_pelapor, pekerjaan_pelapor, hub_peldankor, nomor_pelapor, nama_korban, jk_korban, alamat_korban, pekerjaan_korban, nomor_korban, jenis_kasus, kronologi, tindak_lanjut)
                      VALUES ('$kode', now(), '$_POST[nik]', '$_POST[nama_pelapor]', '$_POST[alamat_pelapor]', '$_POST[pekerjaan_pelapor]', '$_POST[hub_peldankor]', '$_POST[nomor_pelapor]', '$_POST[nama_korban]', '$_POST[jk_korban]', '$_POST[alamat_korban]', '$_POST[pekerjaan_korban]', '$_POST[nomor_korban]', '$_POST[jenis_kasus]', '$_POST[kronologi]', '$_POST[tindak_lanjut]')";
    
            $result = mysqli_query($koneksi, $query);
            $success = true;

          

            
           
        }
    }

    $koneksi->close();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LABRRAK - DP3A Manado</title>
    <link rel="shortcut icon" href="img/logoIcon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/fontawesome.min.css"
        integrity="sha512-UuQ/zJlbMVAw/UU8vVBhnI4op+/tFOpQZVT+FormmIEhRSCnJWyHiBbEVgM4Uztsht41f3FzVWgLuwzUqOObKw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

        <!-- captcha -->
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
         <!-- Google Ajax Api -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

        <style>
            body{
                overflow-x: hidden !important;
            }
            .hero-img{
                display: flex;
                position: absolute;
                top: 0;
                z-index: -1;
            }
            .tittle h2,h4{
                    color:white;
                }

            @media screen and (max-width:426px) {
                .tittle{
                margin-top: -50px;
            }
            }
            @media screen and (max-width:321px) {
                .tittle h2,h4{
                    font-weight: bold;
                    color:black;
                }
            }
            
        </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-transparent">
            <div class="container-fluid">
                <a class="navbar-brand" href="#"><img src="/layout/assets/img/logo.png" alt="" width="50px"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav m-auto text-white">
                        <li class="nav-item me-5">
                            <a class="nav-link active text-white fw-bold" aria-current="page" href="index.php">HOME</a>
                        </li>
                        <li class="nav-item dropdown me-4">
                            <a class="nav-link dropdown-toggle text-white fw-bold" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                              TENTANG DINAS
                            </a>
                            <ul class="dropdown-menu">
                              <li><a class="dropdown-item text-red fw-bold " href="profile_dinas.php">PROFIL DINAS</a></li>
                              <li><a class="dropdown-item text-red fw-bold " href="webcomics.php">WEBCOMICS</a></li>
                            </ul>
                        </li>
                        <li class="nav-item me-5">
                            <a class="nav-link text-white fw-bold" href="panduan.php">PANDUAN</a>
                        </li>
                        <li class="nav-item me-5">
                            <a class="nav-link text-white fw-bold" href="kontak.php">KONTAK</a>
                        </li>
                        <li class="nav-item me-5">
                            <a class="nav-link text-white fw-bold" href="login.php">LOGIN</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main>
    <img class="hero-img" src="./layout/assets/img/kualimerahputih.png" width="100%" alt="">
        <br><br><br>
        <!-- LAPORAN -->
        <div class="container tittle">
            <h2 class="text-center">LABRRAK</h2>
            <h4 class="text-center">Layanan Aduan Korban Kekerasan Perempuan dan Anak</h4>
        </div>

        <div class="container w-50 shadow mt-5 pb-3 pt-3">
            <div class="container bg-danger w-50 text-center p-1 rounded shadow">
                <h4 class="text-white">Ayo Lapor!</h4>
            </div>
            <br><br>
            <div class="container">
                <?php if(isset($error)) { echo "<div class='alert alert-danger'>$error</div>"; } ?>
                <form action="#" method="POST">
                    <div class="mb-3">
                        <input type="text" class="form-control" name="nomor" value="<?php echo $kode;?>" readonly required>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" name="nik" placeholder="NIK *" required pattern="\d{16}" title="NIK harus terdiri dari 16 digit angka dan tidak boleh menggunakan huruf">
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" name="nama_pelapor" placeholder="Nama Pelapor *" required pattern="[a-zA-Z\s]+" title="Nama hanya boleh berisi huruf dan spasi">
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" name="alamat_pelapor" placeholder="Alamat Pelapor *" required>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" name="pekerjaan_pelapor" placeholder="Pekerjaan Pelapor *" required>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" name="hub_peldankor" placeholder="Hubungan Pelaku dan Korban *">
                    </div>
                    <div class="mb-3">
                        <input type="tel" class="form-control" name="nomor_pelapor" placeholder="Nomor Telepon Pelapor *" required pattern="\d{10,15}" title="Nomor telepon pelapor harus terdiri dari 10-15 digit angka">
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" name="nama_korban" placeholder="Nama Korban *" required>
                    </div>
                    <div class="mb-3">
                        <select class="form-control" name="jk_korban" required>
                            <option value="">-- Pilih Jenis Kelamin Korban --</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" name="alamat_korban" placeholder="Alamat Korban *" required>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" name="pekerjaan_korban" placeholder="Pekerjaan Korban *" required>
                    </div>
                    <div class="mb-3">
                        <input type="tel" class="form-control" name="nomor_korban" placeholder="Nomor Telepon Korban" pattern="\d{10,15}" title="Nomor telepon korban harus terdiri dari 10-15 digit angka">
                    </div>
                    <div class="mb-3">
                        <select class="form-control" name="jenis_kasus" required>
                            <option value="">-- Pilih Jenis Kasus Kekerasan --</option>
                            <option value="Fisik">Fisik</option>
                            <option value="Psikis">Psikis</option>
                            <option value="Seksual">Seksual</option>
                            <option value="Penelantaran Anak / Keluarga">Penelantaran Anak / Keluarga</option>
                            <option value="Eksploitasi">Eksploitasi</option>
                            <option value="TPPO">TPPO</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <textarea class="form-control" name="kronologi" rows="3" placeholder="Kronologi Kasus *" required minlength="20" title="Kronologi minimal 20 karakter"></textarea>
                    </div>
                    <div class="mb-3">
                        <textarea class="form-control" name="tindak_lanjut" rows="3" placeholder="Tindak Lanjut *" required></textarea>
                    </div>
                    <div class="mb-3">
                        <div class="g-recaptcha" data-sitekey="6Lf84j4qAAAAAFNQxlDPJijHMdDyH6QR1uiLUSHV"></div>
                    </div>
                    <div class="text-center mt-3"> 
                        <button type="submit" class="btn btn-danger shadow" id="lapor" name="lapor">Lapor Sekarang</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <br><br><br>
<!-- FOOTER SECTION -->
<footer class="" style="background-color: rgb(34, 34, 34); color:#ddd;">
            <!-- Footer -->
            <footer class="footer text-center pt-5 pb-3">
                <div class="row">
                    <div class="col-md-4 mb-5 mb-lg-0">
                        <ul class="list-inline mb-0">
                            <li class="list-inline-item">
                                <i class="fa fa-top fa-map-marker"></i>
                            </li>
                            <li class="list-inline-item">
                                <h4 class="text-uppercase mb-4">Kantor</h4>
                            </li>
                        </ul>
                        <p class="mb-0">
                            Jl. Balaikota No.01 Tikala Ares
                            <br>Manado, Sulawesi Utara
                        </p>
                    </div>
                    <div class="col-md-4 mb-5 mb-lg-0">
                        <ul class="list-inline mb-0">
                            <li class="list-inline-item">
                                <i class="fa fa-top fa-rss"></i>
                            </li>
                            <li class="list-inline-item">
                                <h4 class="text-uppercase mb-4">Sosial Media</h4>
                            </li>
                        </ul>
                        <ul class="list-inline mb-0">
                            <li class="list-inline-item">
                                <a class="btn btn-outline-light btn-social text-center rounded-circle"
                                    href="https://www.facebook.com/profile.php?id=100058956600011&mibextid=uzlsIk/">
                                    <i class="fa fa-fw fa-facebook"></i>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a class="btn btn-outline-light btn-social text-center rounded-circle"
                                    href="https://www.instagram.com/uptdppa.manado?igsh=ZWI2YzEzYmMxYg==">
                                    <i class="fa fa-fw fa-instagram"></i>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a class="btn btn-outline-light btn-social text-center rounded-circle"
                                    href="https://wa.me/6285220044323">
                                    <i class="fa fa-send-o"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <ul class="list-inline mb-0">
                            <li class="list-inline-item">
                                <i class="fa fa-top fa-envelope-o"></i>
                            </li>
                            <li class="list-inline-item">
                                <h4 class="text-uppercase mb-4">Kontak</h4>
                            </li>
                        </ul>
                        <p class="mb-0">
                            Call Center 112 (BEBAS PULSA)<br>
                            0852-2004-4323<br>
                            dpppa.manadokota.go.id
                        </p>
                    </div>
                </div>
            </footer>
            <!-- /footer -->

            <div class="copyright py-4 text-center text-white bg-black">
                <small>v-1.0 | Copyright &copy; DP3A Kota Manado with M.A.Y.A <?php echo date("Y") ?></small>
            </div>
            <!-- shadow -->
    </footer>
    </div>

   

    <script>
        $(document).on('click','#lapor', function(){
            let response = grecaptcha.getResponse();
            if(response.length==0){
                alert("Please veryfy you are not a robot")
                return false
            }
        })

        <?php if (isset($success)): ?>
            swal("Berhasil", "Data Berhasil di Kirim", "success");
        <?php endif; ?>


    </script>
    <!-- SCRIPT.JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>