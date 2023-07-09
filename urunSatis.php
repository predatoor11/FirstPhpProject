<?php include "login-control.php"; ?>
<?php include "timeout.php"; ?>
<?php
  include "./database/connect.php";
  $error = "";
  $disabled = "disabled";
  $enabled = "";
  $display = " style='display: none;'";
  $urunID = ""; $urunAdi = ""; $urunMark = ""; $urunKat = ""; $urunAdet = ""; $urunFiyat = "";
  $max = ""; $id = "";

  $sqlVeri = "SELECT * FROM `urun`";
  $queryVeri = mysqli_query($dbconnect, $sqlVeri); //combobox listelemesini için gerekli komut satırı.

  if(isset($_POST['urunSat']))
  {
    extract($_POST);
    $display = " style='display: block;'";
    $sql = "SELECT * FROM `urun` WHERE `ID` = $urunSat";
    $query = mysqli_query($dbconnect, $sql);
    $urunSatVeri = mysqli_fetch_assoc($query);
    $urunID = $urunSatVeri['ID'];
    $urunAdi = $urunSatVeri['PRODUCT_NAME'];
    $urunMark = $urunSatVeri['PRODUCT_BRAND'];
    $urunKat = $urunSatVeri['PRODUCT_CATEGORY'];
    $urunAdet = $urunSatVeri['PIECE'];
    $urunFiyat = $urunSatVeri['PRICE'];
    $max = " max='$urunAdet'";
    $disabled = "";
  }
  if(isset($_POST['sat']))
  {
    extract($_POST);
    if(isset($success)) { # CHECKBOX ONAYI
      if(!empty($adet)) {
        $dataSql = "SELECT * FROM `urun` WHERE `ID` = $id";
        $dataQuery = mysqli_query($dbconnect, $dataSql);
        $data = mysqli_fetch_assoc($dataQuery);
        $piece = $data['PIECE'];
        $price = $data['PRICE'];

        $piece -= $adet;
        $sum = $adet * $price;
        $insertSql = "INSERT INTO `sold` (PIECE, PRICE, URUN_ID) VALUES ($adet, $sum, $id)";
        mysqli_query($dbconnect, $insertSql);
        $updateSql = "UPDATE `urun` SET `PIECE` = $piece WHERE `ID` = $id";
        mysqli_query($dbconnect, $updateSql);
        $error = "<div class='card card-success p-0 m-0'>
          <div class='card-header'>
            <h3 class='card-title'>İşleminiz başarıyla gerçekleştirildi.</h3>
          </div>
        </div>";
        print "<script>
        setTimeout(function () {
          window.location.href= 'urunSatis.php';
        },2000);</script>";
      } else {
        $error = "<div class='card card-danger p-0 m-0'>
                    <div class='card-header'>
                      <h3 class='card-title'>Satış adetini boş bırakamazsınız.</h3>
                    </div>
                  </div>";
      }
    } else {
      $error = "<div class='card card-danger p-0 m-0'>
                  <div class='card-header'>
                    <h3 class='card-title'>Satış işlemi onayı işaretlenmemiştir.</h3>
                  </div>
                </div>";
    }
  }
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

  <title>Ürün Satışı</title>
  
  <link rel="icon" href="dist/img/logo.svg" type="image/x-icon" />

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <style>
    .inputH {
      width: 0px;
      height: 0px;
      display: none;
      position: relative;
      top: 8px;
      left: 10px;
      visibility: hidden;
    }
  </style>
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
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
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
                <a href="./urunSatis.php" class="nav-link active">
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
            <h1 class="m-0 text-dark">Ürün Satışı</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Anasayfa</a></li>
              <li class="breadcrumb-item active">Ürün Satışı</li>
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
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-secondary">
                <div class="card-header">
                  <h3 class="card-title">Ürün Satış Formu</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                  <div class="card-body">
                    <div class="row">
                      <div class="col-lg-8 offset-lg-2 offset-md-0 text-center pb-1">
                        <h4><b>Ürün Seç</b></h4>
                      </div>
                      <div class="col-lg-8 offset-lg-2 offset-md-0">
                        <div class="form-group">
                          <form role="form" method="POST">
                            <select onchange="this.form.submit()" name="urunSat" class="form-control select2" style="width: 100%;">
                              <option selected disabled>Seç</option>
                              <?php
                                  while($kayit = mysqli_fetch_assoc($queryVeri))
                                  {
                                    print <<<option
                                      <option value="{$kayit['ID']}">{$kayit['PRODUCT_NAME']}</option>
                                    option;
                                  }
                              ?>
                            </select>
                          </form><!-- ./form -->
                        </div>
                      </div><!-- ./col -->
                    </div><!-- ./row -->
                    <div class="form-group table-responsive" <?php echo $display; ?>>
                      <table class="table table-head-fixed text-nowrap">
                        <thead>
                          <tr>
                            <th>Ürün Adı</th>
                            <th>Ürün Markası</th>
                            <th>Ürün Kategorisi</th>
                            <th>Ürün Adeti</th>
                            <th>Ürün Fiyatı</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <?php
                              print <<<td
                                  <td>$urunAdi</td>
                                  <td>$urunMark</td>
                                  <td>$urunKat</td>
                                  <td>$urunAdet</td>
                                  <td>$urunFiyat</td>
                              td;
                            ?>
                          </tr>
                        </tbody>
                      </table>
                    </div><!-- ./form-group ./table-responsive -->
                  <form method="POST">
                    <div class="form-group">
                      <label for="">Satılan Adet</label>
                      <input type="text" name="id" id="id" class="inputH" value="<?php echo $urunID; ?>" hidden>
                      <input type="number" name="adet" id="adet" onkeyup="fonk()" class="form-control col-12 col-lg-3 col-md-4" min="1" <?php echo $max; ?> maxlength="3" placeholder="Adet Giriniz." required="required" <?php echo $disabled; ?>>
                    </div>
                    <div class="custom-control custom-checkbox">
                      <input class="custom-control-input" name="success" type="checkbox" id="Checkbox1" value="option1" <?php echo $disabled; ?> required>
                      <label for="Checkbox1" class="custom-control-label">Satışı Onayla</label>
                    </div>
                  </div>
                  <!-- /.card-body -->

                  <div class="card-footer">
                    <button name="sat" type="submit" class="btn btn-primary" <?php echo $disabled; ?>>Sat</button>
                  </div>
                  </form>
                <?php print $error; ?>
              </div>
              <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
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
<!-- Select2 -->
<script src="plugins/select2/js/select2.full.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- rgb.js -->
<script src="dist/js/rgb.js"></script>
<script type="text/javascript">
    function fonk()
    {
      var num = document.getElementById('adet');
      if(parseInt(num.value) > num.max) {
        num.value = num.max;
      }
      if(parseInt(num.value) <= 0) {
        num.value = 1;
      }

    }
    var invalidChars = [
        "-",
        "+",
        "e",
        "E",
      ];
      var num = document.getElementById('adet');
      num.addEventListener("keydown", function(e) {
        if(invalidChars.includes(e.key)) {
          e.preventDefault();
        }
      });
</script>
<script type="text/javascript">
    $(document).ready(function(){
      //Initialize Select2 Elements
      $('.select2').select2();
    });
</script>

</body>
</html>
