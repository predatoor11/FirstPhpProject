<?php
      unset($_SESSION);
      session_start();
      session_destroy();
      session_start();
      ob_start();
    $error = "";
    include "database/connect.php";

    if(isset($_REQUEST['login']))
    {
        if(!empty($_POST['username']) && !empty($_POST['password']))
        {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $hashpassword = md5(sha1($password));

            $sql = "SELECT * FROM `users` WHERE `USERNAME` = '$username' AND `PASSWORD` = '$hashpassword'";
            $query = mysqli_query($dbconnect, $sql);
            $kayit = mysqli_fetch_assoc($query);
            $id = $kayit['ID'];
            if($kayit['USERNAME'] == $username && $kayit['PASSWORD'] == $hashpassword)
            {
                if($kayit['AKTIF'] == 1)
                {
                    if(isset($_POST['remember']))
                    {
                      $ip = $_SERVER["REMOTE_ADDR"];
                      $sql = "INSERT INTO `log` (USERS_ID) VALUES ($id)";
                      mysqli_query($dbconnect, $sql);
                      $sql = "INSERT INTO `ip` (IP, USERS_ID) VALUES ('$ip', $id)";
                      mysqli_query($dbconnect, $sql);
                      setcookie("username", $username, time() + 3600*24);
                      setcookie("password", $password, time() + 3600*24);

                      $_SESSION["login"] = "Admin";
                      $_SESSION["id"] = $id;
                      $_SESSION["name"] = $kayit['NAME'];
                      $_SESSION["username"] = $username;
                      $_SESSION["password"] = $hashpassword;
                      $_SESSION["admin"] = $kayit['ADMIN'];
                      $_SESSION["last_login_timestamp"] = time();
                      header('location: index.php');
                      exit;
                    }
                    else
                    {
                      $ip = $_SERVER["REMOTE_ADDR"];
                      $sql = "INSERT INTO `log` (USERS_ID) VALUES ($id)";
                      mysqli_query($dbconnect, $sql);
                      $sql = "INSERT INTO `ip` (IP, USERS_ID) VALUES ('$ip', $id)";
                      mysqli_query($dbconnect, $sql);
                      
                      $_SESSION["login"] = "Admin";
                      $_SESSION["id"] = $id;
                      $_SESSION["name"] = $kayit['NAME'];
                      $_SESSION["username"] = $username;
                      $_SESSION["password"] = $hashpassword;
                      $_SESSION["admin"] = $kayit['ADMIN'];
                      $_SESSION["last_login_timestamp"] = time();
                      header('location: index.php');
                      exit;
                    }
                }
                else
                {
                  $error = <<<error
                  <div class='row'>
                    <div class='col-12 pt-2'>
                      <div class='card card-danger'>
                        <div div class='card-header'>
                          <h4 class='card-title'>Hesabınız aktif değildir!</h4>
                        </div>
                      </div>
                    </div>
                  </div>
                  error;
                }
            }
            else
            {
              $error = <<<error
              <div class='row'>
                <div class='col-12 pt-2'>
                  <div class='card card-danger'>
                    <div div class='card-header'>
                      <h4 class='card-title'>Kullanıcı adınız veya şifreniz hatalı!</h4>
                    </div>
                  </div>
                </div>
              </div>
              error;
            }
        }
    }

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  
  <title>Giriş Yap</title>
    
  <link rel="icon" href="dist/img/logo.svg" type="image/x-icon" />

  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <style>
    .agla:hover {
      color: #a32d;
      transition: .5s;
    }
  </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <b>Giriş Yap</b>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Oturumu başlatmak için giriş yapınız</p>

      <form method="POST">
        <div class="input-group mb-3">
          <input type="text" name="username" class="form-control" value="admin" placeholder="Username" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-id-card"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" id="pass" ondblclick="showPass()" class="form-control" value="1234" placeholder="Password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock agla" onclick="showPass()"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" name="remember" id="remember">
              <label for="remember">
                Beni Hatırla
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" name="login" class="btn btn-primary btn-block">Giriş Yap</button>
          </div>
          <!-- /.col -->
        </div>
        <?php
          echo $error;
        ?>
      </form>
      <!-- /.social-auth-links -->

      <!-- <p class="mb-1">
        <a href="">I forgot my password</a>
      </p> -->
      <!-- <p class="mb-0">
        <a href="" class="text-center">Register a new membership</a>
      </p> -->
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<script type="text/javascript">
  function showPass() {
    var login = document.getElementById('pass');
    if(login.type == "password") {
        login.type = "text";
    } else {
        login.type = "password";
    }
  }
</script>
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

</body>
</html>
