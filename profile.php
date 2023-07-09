<?php include "login-control.php"; ?>
<?php include "timeout.php"; ?>
<?php include "database/connect.php"; ?>
<?php
    $error = "";
    $success = "";
    $sql = "SELECT * FROM `profile` WHERE `ID` = {$_SESSION['id']}";
    $query = mysqli_query($dbconnect, $sql);
    $kayit = mysqli_fetch_assoc($query);
    $education = $kayit['EDUCATION'];
    $location = $kayit['LOCATION'];
    $skills = $kayit['SKILLS'];
    $pinfo = $kayit['PINFO'];

    if(isset($_POST['bguncelle']))
    {
        extract($_POST);
        $sql = "UPDATE `profile` SET `EDUCATION` = '$education', `LOCATION` = '$education', `SKILLS` = '$skills', `PINFO` = '$pinfo' WHERE `USERS_ID` = {$_SESSION['id']}";
        mysqli_query($dbconnect, $sql);
    }
    else if(isset($_POST['sguncelle']))
    {
        extract($_POST);
        if(!empty($oldpass) && !empty($newpass) && !empty($agnpass))
        {
            $sql = "SELECT * FROM `users` WHERE `ID` = {$_SESSION['id']}";
            $query = mysqli_query($dbconnect, $sql);
            $kayit = mysqli_fetch_assoc($query);
            $password = $kayit['PASSWORD'];
            $oldpass = md5(sha1($oldpass));
            if($password === $oldpass)
            {
                if($newpass === $agnpass)
                {
                  if($_SESSION['id'] == 9) {

                    $success = <<<success
                    <div class='row'>
                      <div class='col-12 pt-2'>
                        <div class='card card-danger'>
                          <div div class='card-header'>
                            <h4 class='card-title'>Test kullanıcısının şifresini değiştiremezsiniz.</h4>
                          </div>
                        </div>
                      </div>
                    </div>
                    success;

                  } else {

                    $hashpassword = md5(sha1($newpass));
                    $sql = "UPDATE `users` SET `PASSWORD` = '$hashpassword' WHERE `ID` = {$_SESSION['id']}";
                    mysqli_query($dbconnect, $sql);

                    $success = <<<success
                    <div class='row'>
                      <div class='col-12 pt-2'>
                        <div class='card card-success'>
                          <div div class='card-header'>
                            <h4 class='card-title'>Şifreniz başarıyla değiştirildi.</h4>
                          </div>
                        </div>
                      </div>
                    </div>
                    success;
                    print "<script>
                    setTimeout(function () {
                      window.location.href= 'profile.php';
                   },1000);</script>";

                  }

                }
                else
                {
                    $error = <<<error
                    <div class='row'>
                      <div class='col-12 pt-2'>
                        <div class='card card-danger'>
                          <div div class='card-header'>
                            <h4 class='card-title'>Yeni Şifreniz ve Tekrar Şifreniz uyuşmamaktadır!</h4>
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
                        <h4 class='card-title'>Eski Şifrenizi doğru değildir!</h4>
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
                    <h4 class='card-title'>Tüm alanlar zorunludur!</h4>
                  </div>
                </div>
              </div>
            </div>
            error;
        }
    }

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>Kullanıcı Profili</title>  
  
  <link rel="icon" href="dist/img/logo.svg" type="image/x-icon" />

  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini sidebar-collapse">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="index.php" class="nav-link">Anasayfa</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="iletisim.php" class="nav-link">Destek</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">1</span> <!-- Mesaj Sayısı -->
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            
            <!-- Message Start -->
            <div class="media">
              <img src="dist/img/logo.svg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    Doğu Nigar
                    <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">Paneli kullanmakta zorluk çekiyorsanız "Panel Eğitim" sayfasından kullanımını öğrenebilirsiniz.</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 12.04.2020</p>
                </div>
            </div>
            <!-- Message End -->
          </a>
          
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Admin Panel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <a href="profile.php">
            <img src="dist/img/logo.svg" class="img-circle elevation-2" alt="Logo">
          </a>
        </div>
        <div class="info">
          <a href="profile.php" class="d-block">
            <?php
              echo $_SESSION['name'];
            ?>
          </a>
        </div>
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="index.php" class="nav-link">
              <i class="fas fa-home nav-icon"></i>
              <p>Anasayfa</p>
            </a>
          </li>
          <?php
            if($_SESSION['admin'] == 1)
            {
              print <<<admin
                <li class="nav-item">
                  <a href="admin.php" class="nav-link">
                    <i class="fas fa-user-cog nav-icon"></i>
                    <p>Admin</p>
                  </a>
                </li>
              admin;
            }
          ?>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Ürün
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li i class="nav-item">
                <a href="./urunEkle.php" class="nav-link">
                  <i class="fas fa-cart-plus nav-icon"></i>
                  <p>Ürün Ekle</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./urunDuzenle.php" class="nav-link">
                  <i class="fas fa-shopping-cart nav-icon"></i>
                  <p>Ürün Düzenle</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./urunSatis.php" class="nav-link">
                  <i class="fas fa-hand-holding-usd nav-icon"></i>
                  <p>Ürün Satışı</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="iletisim.php" class="nav-link">
              <i class="fas fa-question nav-icon"></i>
              <p>Destek</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="panelEgitim.php" class="nav-link">
              <i class="fas fa-book-open nav-icon"></i>
              <p>Panel Eğitimi</p>
            </a>
          </li>
          <?php
            if($_SESSION['admin'] == 1)
            {
              print <<<admin
                <li class="nav-item">
                  <a href="./upload/projeDosyasi.rar" class="nav-link">
                    <i class="fas fa-folder nav-icon"></i>
                    <p id="rgb">PROJE DOSYALARI</p>
                  </a>
                </li>
              admin;
            }
          ?>
          <li class="nav-item">
            <a href="logout.php" class="nav-link">
              <i class="fas fa-sign-out-alt nav-icon"></i>
              <p>Logout</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profil</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Anasayfa</a></li>
              <li class="breadcrumb-item active">Profil</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-4">

            <!-- About Me Box -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Hakkımda</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <strong><i class="fas fa-book mr-1"></i> Eğitim</strong>

                <p class="text-muted">
                  <?php echo $education; ?>
                </p>

                <hr>

                <strong><i class="fas fa-map-marker-alt mr-1"></i> Konum</strong>

                <p class="text-muted"><?php echo $location; ?></p>

                <hr>

                <strong><i class="fas fa-pencil-alt mr-1"></i> Beceriler</strong>

                <p class="text-muted">
                    <?php echo $skills; ?>
                </p>

                <hr>

                <strong><i class="far fa-file-alt mr-1"></i> Kişisel Bigliler</strong>

                <p class="text-muted"><?php echo $pinfo; ?></p>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-8">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Bilgilerimi Güncelle</a></li>
                  <li class="nav-item"><a class="nav-link" href="#changePassword" data-toggle="tab">Şifre Değiştir</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="settings">
                    <!-- The timeline -->
                    <form class="form-horizontal" method="POST">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Eğitim</label>
                        <div class="col-sm-10">
                            <input class="form-control form-control-md" type="text" name="education" value="<?php echo $education; ?>" placeholder="Education">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Konum</label>
                        <div class="col-sm-10">
                            <input class="form-control form-control-md" type="text" name="location" value="<?php echo $location; ?>" placeholder="Location">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputExperience" class="col-sm-2 col-form-label">Beceriler</label>
                        <div class="col-sm-10">
                            <input class="form-control form-control-md" type="text" name="skills" value="<?php echo $skills; ?>" placeholder="Skills">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">Kişisel Bilgiler</label>
                        <div class="col-sm-10">
                            <input class="form-control form-control-md" type="text" name="pinfo" value="<?php echo $pinfo; ?>" placeholder="Personel Information">
                        </div>
                      </div>
                      <div class="row pb-4">
                          <div class="col-sm-2"></div>
                          <div class="col-sm-10"><u>Html etiketleri geçerlidir.</u>
                            <br><code> &lt;br&gt;</code> komutu alt satıra geçer.
                            <br><code>&lt;h4&gt;</code><h4 class="d-inline-block">Test</h4><code>&lt;/h4&gt;</code> &nbsp; 
                            <code>&lt;h5&gt;</code><h5 class="d-inline-block">Test</h5><code>&lt;/h5&gt;</code> komutu arasına yazılanlar büyük harf olur.</div>

                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" name="bguncelle" class="btn btn-success">Güncelle</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->

                  <div class="tab-pane" id="changePassword">
                    <form class="form-horizontal" method="POST">
                      <div class="form-group row">
                        <label for="inputExperience" class="col-sm-2 col-form-label">Eski Şifre*</label>
                        <div class="col-sm-6">
                            <input type="password" name="oldpass" class="form-control" id="oldpass" placeholder="Old Password" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputExperience" class="col-sm-2 col-form-label">Yeni Şifre*</label>
                        <div class="col-sm-6">
                            <input type="password" name="newpass" class="form-control" id="newpass" placeholder="New Password" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">Tekrar Şifre*</label>
                        <div class="col-sm-6">
                          <input type="password" name="agnpass" class="form-control" id="agnpass" placeholder="Again Password" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <div class="checkbox">
                            <label>
                              <input type="checkbox" id="control" onclick="passGoster()"> &nbsp;<span id="text">Şifreyi Göster</span>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" name="sguncelle" class="btn btn-success">Güncelle</button>
                        </div>
                      </div>
                    </form>
                    <?php echo $error; ?>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
        <?php echo $success; ?>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

  
    <!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
</aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Healthy Days
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2020</strong>
  </footer>
</div>
<!-- ./wrapper -->
<script type="text/javascript">
    function passGoster() {
        var a = document.getElementById('control');
        var button1 = document.getElementById('oldpass');
        var button2 = document.getElementById('newpass');
        var button3 = document.getElementById('agnpass');
        var text = document.getElementById('text');
        if(a.checked == true) {
            button1.type = "text";
            button2.type = "text";
            button3.type = "text";
            text.innerHTML = "Şifreyi Gizle";
        } else {
            button1.type = "password";
            button2.type = "password";
            button3.type = "password";
            text.innerHTML = "Şifreyi Göster";
        }
    }

</script>
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- rgb.js -->
<script src="dist/js/rgb.js"></script>
</body>
</html>
