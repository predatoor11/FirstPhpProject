<?php include "login-control.php"; ?>
<?php include "timeout.php"; ?>
<?php
  include "database/connect.php";

  include "2x.php"; /* Eğer ürün adeti 10'dan azsa bu php fonksiyonu çalışacak. */
  zamVeIndirim(); /* 2x.php içindeki zam&indirim Fonksiyonunu çağırır */
  $toplamKazanc = toplamKazanc();
  $toplamSatilanUrun = toplamSatilanUrun();

  $sql = "SELECT SUM(`PIECE`) AS `PIECE_SUM` FROM `urun`";
  $query = mysqli_query($dbconnect, $sql);
  $kayit = mysqli_fetch_assoc($query);
  $inventory_sum = $kayit['PIECE_SUM'];
  $sql = "SELECT COUNT(`ID`) AS `ID_COUNT` FROM `urun`";
  $query = mysqli_query($dbconnect, $sql);
  $kayit = mysqli_fetch_assoc($query);
  $inventory = $kayit['ID_COUNT'];


  $ozelSorgu = "SELECT * FROM `urun` WHERE `PIECE` <= 10 AND `PIECE` > 0";
  $ozelQuery = mysqli_query($dbconnect, $ozelSorgu);
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
            <a href="index.php" class="nav-link active">
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
            <h1 class="m-0 text-dark">Gösterge Paneli</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Anasayfa</li>
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
          <div class="col-lg-9 col-md-12">
            

          <div id="donutchart" style="height: 375px;"></div>


          </div>
          <div class="col-lg-3">
            <div class="info-box mb-3 bg-success">
              <span class="info-box-icon"><i class="fas fa-dolly-flatbed"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Envanter</span>
                <span class="info-box-number"><?php echo $inventory; ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            <div class="info-box mb-3 bg-warning">
              <span class="info-box-icon"><i class="fas fa-boxes"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Envanter Toplamı</span>
                <span class="info-box-number"><?php echo $inventory_sum; ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            <div class="info-box mb-3 bg-danger">
              <span class="info-box-icon"><i class="fas fa-hand-holding-usd"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Toplam Kazanç</span>
                <span class="info-box-number"><?php echo $toplamKazanc; ?> <em class="float-right">TL</em></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            <div class="info-box mb-3 bg-info">
              <span class="info-box-icon"><i class="fas fa-shopping-cart"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Toplam Satılan Ürün</span>
                <span class="info-box-number"><?php echo $toplamSatilanUrun; ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
        </div>
        <!-- /.row -->
        <div class="row">
          <div class="col-lg-12">
            
            <div class="card card-danger">
              <div class="card-header border-0">
                <h3 class="card-title">Tükenmek Üzere Olan Ürünler</h3>
                <h3 class="card-title float-right">Adetleri düşen ürünler otomatik olarak zamlanır!</h3>
              </div>
              <div class="card-body table-responsive p-0">
                <table class="table table-striped table-valign-middle">
                  <thead>
                  <tr>
                    <th>Adı</th>
                    <th>Markası</th>
                    <th>Kategorisi</th>
                    <th>Adeti</th>
                    <th>Ö. Fiyatı </th>
                    <th>S. Fiyatı (%20)</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php

                      $sayac = indexSayac();
                      for($j = 0; $j < $sayac; $j++)
                      {
                        $ozelKayit = mysqli_fetch_assoc($ozelQuery);
                        $price = $ozelKayit['PRICE'];
                        $extra = $ozelKayit['EXTRA'];
                        print <<<yaz
                          <tr>
                            <td>{$ozelKayit['PRODUCT_NAME']}</td>
                            <td>{$ozelKayit['PRODUCT_BRAND']}</td>
                            <td>{$ozelKayit['PRODUCT_CATEGORY']}</td>
                            <td><center>{$ozelKayit['PIECE']}</center></td>
                            <td>$price</td>
                            <td>{$ozelKayit['EXTRA']}</td>
                          </tr>
                        yaz;
                      }
                    ?>
                  </tbody>
                </table>
              </div>
            </div><!-- /.card -->

          </div><!-- /.col -->
        </div><!-- /.row -->
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
<script type="text/javascript">

</script>
<!-- REQUIRED SCRIPTS -->
<?php
  $enCok = enCokTercihEdilenUrunler();
  $enCokAd = array();
  $enCokAdet = array();
  for($j = 0; $j < count($enCok); $j++)
  {
      $enCokAdet[$j] = substr($enCok[$j], 0, strpos($enCok[$j], " "));
      $enCokAd[$j] = substr($enCok[$j], strpos($enCok[$j], " "));
  }
?>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Day per Week'],
          ['<?php echo $enCokAd[0]; ?>',<?php echo $enCokAdet[0]; ?>],
          ['<?php echo $enCokAd[1]; ?>',<?php echo $enCokAdet[1]; ?>],
          ['<?php echo $enCokAd[2]; ?>',<?php echo $enCokAdet[2]; ?>],
          ['<?php echo $enCokAd[3]; ?>',<?php echo $enCokAdet[3]; ?>],
          ['<?php echo $enCokAd[4]; ?>',<?php echo $enCokAdet[4]; ?>],
          ['<?php echo $enCokAd[5]; ?>',<?php echo $enCokAdet[5]; ?>],
          ['<?php echo $enCokAd[6]; ?>',<?php echo $enCokAdet[6]; ?>],
        ]);

        var options = {
          title: 'En çok tercih edilen ürünler.',
          pieHole: 1,
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
      }
    </script>
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
