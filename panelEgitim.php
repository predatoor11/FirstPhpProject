<?php include "login-control.php"; ?>
<?php include "timeout.php"; ?>
<?php
  include "database/connect.php";
  
?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="tr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Gösterge Paneli - Anasayfa</title>
  
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
        <a href="index.php" class="nav-link active">Anasayfa</a>
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
              echo $_SESSION["name"];
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
            <a href="iletisim.php" class="nav-link">
              <i class="fas fa-question nav-icon"></i>
              <p>Destek</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="panelEgitim.php" class="nav-link active">
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
            <h1 class="m-0 text-dark">Panel Eğitimi</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Anasayfa</a></li>
              <li class="breadcrumb-item active">Panel Eğitimi</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            
              <?php
                if($_SESSION['id'] == 1)
                {
                  print <<<yaz
                    <div class="card card-dark bg-light">
                      <div class="card-header">
                        <div class="card-title"><span style="color: lightgreen;">Admin</span> için temel eğitim</div>
                        <div class="card-tools">
                          <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        </div>
                      </div>
                      <div class="card-body">
                        <div class="row">
                          <div class="col-4">
                            <a href="dist/img/Education/admin2.png" target="_blank"><img src="dist/img/Education/admin2.png" class="col-12" alt=""></a>
                            <div class="p-2">Kullanıcı eklemek için gerekli kutular doldurulur, yetkiler ayarlanır ve 'Ekle' butonuna tıklanır.</div>
                          </div>
                          <div class="col-4">
                            <a href="dist/img/Education/admin1.png" target="_blank"><img src="dist/img/Education/admin1.png" class="col-12" alt=""></a>
                            <div class="p-2"><b>1. Adım:</b> ID belirtilmeli.<br><b>2. Adım:</b> Yapılacak işlem seçilmeli.</div>
                          </div>
                          <div class="col-4">
                            <a href="dist/img/Education/admin3.png" target="_blank"><img src="dist/img/Education/admin3.png" class="col-12" alt=""></a>
                            <div class="p-2">2. Resimden yola çıkarak düzenleme yapmak istediğiniz kullanıcı ID'sini girdikten sonra 'Düzenle' butonuna tıklayınız.<br>
                            Verileri üzerinde düzeltme yapıldıktan sonra 'Güncelle' butonuna tıklayabilirsiniz.<br>
                            <span style="color: #d00;"><b>Not: </b>Güncelleme yaparken şifre kısmı boş kaldığı taktirde şifre üzerinde değişiklik olmayacaktır.</span></div>
                          </div>
                        </div>
                      </div>
                      <div class="card-footer">
                        <b>Bu eğitim sadece "Admin" adı altında bulunan tek kullanıcıya aittir.</b>
                      </div>
                    </div>
                  yaz;
                }
              ?>
              <div class="card card-dark bg-light <?php if($_SESSION['id'] == 1) {echo "collapsed-card";} ?>"><!-- CARD -->
                <div class="card-header">
                  <div class="card-title">Ürün - Temel Eğitim</div>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-<?php if($_SESSION['id'] == 1) {echo "plus";}else{echo "minus";} ?>"></i></button>
                  </div>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-4">
                      <a href="dist/img/Education/urun1.png" target="_blank"><img src="dist/img/Education/urun1.png" class="col-12" alt=""></a>
                      <div class="p-2">Gerekli bilgiler doldurulduktan sonra 'Ürün Ekle' butonuna tıklayabilir ve ürünü envanterinize ekleyebilirsiniz.</div>
                    </div>
                    <div class="col-4">
                      <a href="dist/img/Education/urun2.png" target="_blank"><img src="dist/img/Education/urun2.png" class="col-12" alt=""></a>
                      <div class="p-2"><b>1. Adım:</b> ID belirtilmeli.<br><b>2. Adım:</b> Yapılacak işlem seçilmeli.</div>
                    </div>
                    <div class="col-4">
                      <a href="dist/img/Education/urun3.png" target="_blank"><img src="dist/img/Education/urun3.png" class="col-12" alt=""></a>
                      <div class="p-2">Ürün bilgileri güncellendikten sonra 'Güncelle' butonuna tıklamak bilgileri güncellemeye yetecektir.</div>
                    </div>
                  </div>
                </div>
              </div><!-- /.CARD -->

              <div class="card card-dark bg-light collapsed-card"><!-- CARD -->
                <div class="card-header">
                  <div class="card-title">Profil - Temel Eğitim</div>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                  </div>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-6">
                      <a href="dist/img/Education/profil1.png" target="_blank"><img src="dist/img/Education/profil1.png" class="col-12" alt=""></a>
                      <div class="p-2">
                        Profilinizi yaratmanız için kullanabileceğiniz bir kısımdır. Profilin daha sonraki çalışmalarımızda kullanıcılar arası bilgi aktarımı ve
                        yeni iş olanaklarının sağlanması için geliştirilecektir.
                      </div>
                    </div>
                    <div class="col-6">
                      <a href="dist/img/Education/profil2.png" target="_blank"><img src="dist/img/Education/profil2.png" class="col-12" alt=""></a>
                      <div class="p-2">Hesabınızın şifresini kolaylıkla değiştirebileceğiniz kısım resimde görüntülendiği gibidir.</div>
                    </div>
                  </div>
                </div>
              </div><!-- /.CARD -->
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
