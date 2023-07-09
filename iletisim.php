<?php include "login-control.php"; ?>
<?php include "timeout.php"; ?>
<?php include "database/connect.php"; ?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Destek & İletişim</title>
  
  <link rel="icon" href="dist/img/logo.svg" type="image/x-icon" />

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
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
        <a href="iletisim.php" class="nav-link active">Destek</a>
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
              <li class="nav-item">
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
            <a href="iletisim.php" class="nav-link active">
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
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Destek & İletişim</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Anasayfa</a></li>
              <li class="breadcrumb-item active">Destek</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <?php
    $error = "";
    if(isset($_REQUEST['send']))
    {
      extract($_POST);
      if(!empty($name) && !empty($email) && !empty($message) && !empty($select))
      {
        $sql = "INSERT INTO `contact` (`NAME`, `EMAIL`, `TYPE`, `MESSAGE`)
                VALUES ('$name','$email','$select','$message')";
        mysqli_query($dbconnect, $sql);
        $error = "<div class='card card-success mx-3 p-0'>
                    <div class='card-header'>
                      <h3 class='card-title'>Mesajınız başarıyla gönderilmiştir.</h3>
                    </div>
                  </div>";
        $ip = $_SERVER["REMOTE_ADDR"];
        $ipName = "";
        //$ipName = $_SERVER["REMOTE_USER"];
        $sql = "INSERT INTO `ip` (IP, NAME) VALUES ('$ip', '$ipName')";
        mysqli_query($dbconnect, $sql);
        print "<script>
                setTimeout(function () {
                  window.location.href= 'iletisim.php';
                },3000);</script>";
      } else {
        $error = "<div class='card card-danger mx-3 p-0'>
                    <div class='card-header'>
                      <h3 class='card-title'>Boş alan bırakamazsınız.</h3>
                    </div>
                  </div>";
      }
    }
    
    ?>
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- /.col-md-6 -->
          <div class="col-lg-12">
          <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Destek & İletişim Formu</h3>
              </div>
              <!-- /.card-header -->
              <form role="form" method="POST">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Ad Soyad*</label>
                        <input type="text" name="name" class="form-control">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>E-Posta*</label>
                        <input type="email" name="email" class="form-control">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- textarea -->
                      <div class="form-group">
                        <label>Mesajınızı yazınız*</label>
                        <textarea name="message" class="form-control" style="min-height: 40px; max-height: 300px;" rows="3"></textarea>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <!-- select -->
                      <div class="form-group">
                        <label>Destek Türü*</label>
                        <select name="select" class="form-control">
                          <option>Destek</option>
                          <option>Öneri</option>
                          <option>Şikayet</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row m-0 p-0">
                  <div class="col">
                    <?php
                      print $error;
                    ?>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" name="send" class="btn btn-success">Gönder</button>
                  <button type="reset" class="btn btn-danger float-right">İptal et</button>
                </div>
              </form>
              <!-- /.card-footer -->
            </div>
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
        <div class="row pb-3">
          <div class="col-lg-12">
            
            <div class="mapouter"><div class="gmap_canvas"><iframe width="100%" height="350" id="gmap_canvas" src="https://maps.google.com/maps?q=Antalya%20bilim%20%C3%BCniversitesi&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://google-maps-generator.com">google maps creator</a></div><style>.mapouter{position:relative;text-align:right;height:350px;width:100%;}.gmap_canvas {overflow:hidden;background:none!important;height:350px;width:100%;}</style></div>

          </div>
        </div>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

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

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- rgb.js -->
<script src="dist/js/rgb.js"></script>
</body>
</html>
