<?php
  session_start();
  require 'function/functions.php';

  if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query to retrieve user data
    $query = "SELECT * FROM admin WHERE username = '$username' AND password ='$password'";
    $result = $koneksi->query($query);

    if ($result !==  false && $result->num_rows > 0) {
      $data = $result->fetch_assoc();
      $_SESSION['username']=$data['username'];
      header("Location: dashboard.php");
    }else{
      $error = true;
    }
    
  }

 

 

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login | Laporan-Ku</title>
  <link rel="shortcut icon" href="img/logoIcon.png">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/login.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/"
    crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!-- captcha -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
         <!-- Google Ajax Api -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

  <style>
    body {
      background: url('img/bgLogin.png');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      font-family: "roboto", sans-serif;
    }
    .img {
      background: url('img/login.png');
      background-size: cover;
      background-position: center;
      height: 100%;
      top: 0;
      position: absolute;
      width: 100%;
      z-index: 2;
  }
  @media screen and (max-width:426px) {
    .card{
      width: 80%;
      height: 80vh;
      display:flex;
      justify-content:center;
      align-items:center;
    }
    .card-wrap{
      display: flex;
      justify-content:center;
      align-items:center;
    }
    .card-body{
      height: 30vh !important;
    }
  }
  
  </style>
</head>

<body>
  <div class="container">
    <div class="row justify-content-md-center mt-12">
          <div class="col-sm-6 p-0 card-wrap">
            <div class="card">
              <div class="card-header">
                <div class="login">
                  <h4 class="aktif">LOGIN</h4>
                </div>
                <div class="sub-title">( Login untuk Admin LABRRAK )</div>
              </div>
              <div class="icon-user">
                <h4 class="fa fa-user"></h4>
              </div>
              <div class="card-body">
                <form action="login.php" method="POST">
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-user"></i></span>
                    </div>
                    <input type="text" name="username" class="form-control" placeholder="Username / email" autocomplete="off" required>
                  </div>

                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-lock"></i></span>
                    </div>
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                  </div>
                  <div class="form-group">
                      <div class="g-recaptcha" data-sitekey="6Lci-D4qAAAAANGmT7XKc2HrZK5ZPTkiQk8_owcN"></div>
                  </div>
                    <button type="submit" id="login" name="login" value="login" class="btn btn-primary" style="margin-top: -15px">Login</button>
                    <a href="index.php"><span class="btn btn-primary" style="margin-top: -15px;">Kembali</span></a>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  
  <!-- Captcha -->
  <script>
        $(document).on('click','#login', function(){
            let response = grecaptcha.getResponse();
            if(response.length==0){
                alert("Please veryfy you are not a robot")
                return false
            }
        })

    <?php if (isset($error)): ?>
      swal("Login Gagal", "Username atau password salah!", "error");
    <?php endif; ?>
    </script>


  <script src="js/slidelogin.js"></script>
</body>
</html>