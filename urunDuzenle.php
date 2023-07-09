<?php include "login-control.php"; ?>
<?php include "timeout.php"; ?>
<?php include "database/connect.php"; ?>
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

  <title>Ürün Düzenle</title>
  
  <link rel="icon" href="dist/img/logo.svg" type="image/x-icon" />

  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <style>
    thead tr th {
      color: #0069bc;
      cursor: pointer;
    }
    thead tr th:hover {
      color: #128d86;
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
                <a href="./urunDuzenle.php" class="nav-link active">
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
            <h1 class="m-0 text-dark">Ürün Düzenle</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Anasayfa</a></li>
              <li class="breadcrumb-item active">Ürün Düzenle</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <!-- /.row -->
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Ürün Listele</h3>
                <div class="card-tools">
                  <form method="POST">
                    <div class="input-group input-group-sm" style="width: 200px;">
                      <input type="text" name="table_search" class="form-control float-right" placeholder="Ara">

                      <div class="input-group-append">
                        <button type="submit" name="search" class="btn btn-default"><i class="fas fa-search"></i></button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <!-- /.card-header -->
              <?php
                    $error = "";
                    $error1 = "";
                if(isset($_POST['search']))
                {
                  extract($_POST);
                  if(!empty($table_search))
                  {
                    print "<div class='card-body table-responsive p-0' style='height: 500px;'>";

                    $sql = "SELECT * FROM `urun` WHERE CONCAT(`ID`, `PRODUCT_NAME`, `PRODUCT_BRAND`, `PRODUCT_CATEGORY`) LIKE ('%$table_search%')";
                    $query = mysqli_query($dbconnect, $sql) or die("Query error: <b>$sql<hr></b>");
                    if(mysqli_num_rows($query) > 0)
                    {
                      print <<<_
                      <table class="table table-head-fixed text-nowrap">
                        <thead>
                          <tr>
                      _;
                      $a = 0;
                        print <<<_
                          <th>ID</th>
                          <th>ÜRÜN ADI</th>
                          <th>ÜRÜN MARKASI</th>
                          <th>ÜRÜN KATEGORİSİ</th>
                          <th>ÜRÜN ADETİ</th>
                          <th>ÜRÜN FİYATI</th>
                        _;
                      print "</tr></thead>";
                      print "<tbody>";
                      while($kayit = mysqli_fetch_assoc($query))
                      {
                        $id = $kayit['ID'];
                        print <<<_
                          <tr>
                            <td>$id</td>
                            <td>{$kayit['PRODUCT_NAME']}</td>
                            <td>{$kayit['PRODUCT_BRAND']}</td>
                            <td>{$kayit['PRODUCT_CATEGORY']}</td>
                            <td>{$kayit['PIECE']}</td>
                            <td>{$kayit['PRICE']} <b>TL</b></td>
                          </tr>
                          _;
                      }
                      print "</tbody></table>";
                    } else {
                      $error1 = "<div class='card card-danger mt-3'>
                                  <div class='card-header'>
                                    <h3 class='card-title'>Veri bulunamadı.</h3>
                                  </div>
                                </div>";
                    }
                    print "</div>";
                  } else {
                    print "<div class='card-body table-responsive p-0' style='height: 500px;'>";
                    $error = "";

                    $sql = "SELECT * FROM `urun`";
                    $query = mysqli_query($dbconnect, $sql) or die("Query error: <b>$sql<hr></b>");
                    if(mysqli_num_rows($query) > 0)
                    {
                      print <<<_
                      <table class="table table-head-fixed text-nowrap">
                        <thead>
                          <tr>
                      _;
                      $a = 0;
                        print <<<_
                          <th>ID</th>
                          <th>ÜRÜN ADI</th>
                          <th>ÜRÜN MARKASI</th>
                          <th>ÜRÜN KATEGORİSİ</th>
                          <th>ÜRÜN ADETİ</th>
                          <th>ÜRÜN FİYATI</th>
                        _;
                      print "</tr></thead>";
                      print "<tbody>";
                      while($kayit = mysqli_fetch_assoc($query))
                      {
                        $id = $kayit['ID'];
                        print <<<_
                          <tr>
                            <td>$id</td>
                            <td>{$kayit['PRODUCT_NAME']}</td>
                            <td>{$kayit['PRODUCT_BRAND']}</td>
                            <td>{$kayit['PRODUCT_CATEGORY']}</td>
                            <td>{$kayit['PIECE']}</td>
                            <td>{$kayit['PRICE']} <b>TL</b></td>
                          </tr>
                          _;
                      }
                      print "</tbody></table>";
                    } else {
                      $error1 = "<div class='card card-danger mt-3'>
                                  <div class='card-header'>
                                    <h3 class='card-title'>Veri bulunamadı.</h3>
                                  </div>
                                </div>";
                    }
                    print "</div>";
                  }
                } else {
                    print "<div class='card-body table-responsive p-0' style='height: 500px;'>";
                    $error = "";

                    $sql = "SELECT * FROM `urun`";
                    $query = mysqli_query($dbconnect, $sql) or die("Query error: <b>$sql<hr></b>");
                    if(mysqli_num_rows($query) > 0)
                    {
                      print <<<_
                      <table class="table table-head-fixed text-nowrap">
                        <thead>
                          <tr>
                      _;
                      $a = 0;
                        print <<<_
                          <th id="test">ID</th>
                          <th>ÜRÜN ADI</th>
                          <th>ÜRÜN MARKASI</th>
                          <th>ÜRÜN KATEGORİSİ</th>
                          <th>ÜRÜN ADETİ</th>
                          <th>ÜRÜN FİYATI</th>
                        _;
                      print "</tr></thead>";
                      print "<tbody>";
                      while($kayit = mysqli_fetch_assoc($query))
                      {
                        $id = $kayit['ID'];
                        print <<<_
                          <tr>
                            <td>$id</td>
                            <td>{$kayit['PRODUCT_NAME']}</td>
                            <td>{$kayit['PRODUCT_BRAND']}</td>
                            <td>{$kayit['PRODUCT_CATEGORY']}</td>
                            <td>{$kayit['PIECE']}</td>
                            <td>{$kayit['PRICE']} <b>TL</b></td>
                          </tr>
                          _;
                      }
                      print "</tbody></table>";
                    } else {
                      $error1 = "<div class='card card-danger mt-3'>
                                  <div class='card-header'>
                                    <h3 class='card-title'>Veri bulunamadı.</h3>
                                  </div>
                                </div>";                      
                    }
                    print "</div>";
                }
              ?>
                

            <div class="row m-0 px-4">
              <div class="col-12 m-0 p-0">
                <div class="form-group m-0 p-0">
                  <label for="">Silinecek/Düzenlenecek ID'yi giriniz.</label>
                </div>
              </div>
            </div>
            <form method="POST" enctype="multipart/form-data">
              <div class="row m-0 p-0">
                <div class="col-4 col-lg-4 col-md-4 col-sm-8">
                  <div class="form-group px-3">
                    <input type="text" class="form-control" name="ID" placeholder="ID">
                  </div>
                </div>
                <div class="col-2 col-sm-2">
                  <button type="submit" name="delete" class="btn btn-block btn-outline-danger">Sil</button>
                </div>
                <div class="col-2 col-sm-2">
                  <button type="submit" name="edit" id="edit" class="btn btn-block btn-outline-warning">Düzenle</button>
                </div>
              </div>
            </form>
            <?php
              print $error1;
            ?>

      <?php
      $collapse = "collapsed-card";
      $class = "plus";
        if(isset($_REQUEST['delete']))
        {
          extract($_POST);
          if(!empty($ID))
          {
            $sql = "DELETE FROM `urun` WHERE `ID` = $ID";
            mysqli_query($dbconnect, $sql);
            print "<script>
              setTimeout(function () {
                window.location.href= 'urunDuzenle.php';
              },100);</script>";
          }
        }
        else if(isset($_REQUEST['edit']))
        {
          extract($_POST);
          if(!empty($ID))
          {
            $collapse = "";
            $class = "minus";
            $sql = "SELECT * FROM `urun` WHERE `ID` = $ID";
            $query = mysqli_query($dbconnect, $sql);
            $kayit = mysqli_fetch_assoc($query);
            $updateID = $kayit['ID'];
            $pName = $kayit['PRODUCT_NAME'];
            $pBrand = $kayit['PRODUCT_BRAND'];
            $pCategory = $kayit['PRODUCT_CATEGORY'];
            $piece = $kayit['PIECE'];
            $price = $kayit['PRICE'];
          }
        }
      ?>
      <!-- /.modal -->
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <!-- SELECT2 EXAMPLE -->
        <div class="card card-default <?php echo $collapse; ?>">
          <div class="card-header">
            <h3 class="card-title">Ürün Düzenleme Formu</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-<?php echo $class; ?>"></i></button>
            </div>
          </div>
          <div class="card-body">
            <form role="form" method="POST">
              <div class="form-group">
                <label for="exampleInputEmail1">Ürün Adı*</label>
                <input type="text" class="form-control" name="productName" id="productName" placeholder="Product Name" value="<?php if(!empty($pName)) {echo $pName;} ?>">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Ürün Markası*</label>
                <input type="text" class="form-control" name="productBrand" placeholder="Product Brand" value="<?php if(!empty($pBrand)) {echo $pBrand;} ?>">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Ürün Kategorisi</label>
                <input type="text" class="form-control" name="productCategory" placeholder="Product Category" value="<?php if(!empty($pCategory)) {echo $pCategory;} ?>">
              </div>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Adet*</label>
                      <input type="text" class="form-control" name="piece" placeholder="Piece" value="<?php if(!empty($piece)) {echo $piece;} ?>">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Fiyat*</label>
                      <input type="text" class="form-control" name="price" placeholder="Price" value="<?php if(!empty($price)) {echo $price;} ?>">
                    </div>
                  </div>
                      <input type="text" hidden class="form-control" name="updateID" value="<?php if(!empty($updateID)) {echo $updateID;} ?>">
                </div>
                  <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" name="success" type="checkbox" id="Checkbox1" value="option1">
                    <label for="Checkbox1" class="custom-control-label">Ürünü Düzenle</label>
                  </div>
                <div class="form-group pt-3 m-0">
                  <button name="update" id="update" type="submit" class="btn btn-primary">Güncelle</button>
                </div>
            </form>
              <?php

                if(isset($_POST['update']))
                {
                  extract($_POST);
                  if(isset($success))
                  {
                    if(!empty($productName) && !empty($piece) && !empty($price))
                    {
                      $sorgu = "UPDATE `urun` SET `PRODUCT_NAME` = '$productName', `PRODUCT_BRAND` = '$productBrand', 
                      `PRODUCT_CATEGORY` = '$productCategory', `PIECE` = $piece, `PRICE` = $price 
                      WHERE `ID` = $updateID";
                      mysqli_query($dbconnect, $sorgu);
                      print "<script>
                      setTimeout(function () {
                        window.location.href= 'urunDuzenle.php';
                      },100);</script>";
                    } else {
                      $error = "<div class='card card-danger mt-3'>
                                  <div class='card-header'>
                                    <h3 class='card-title'>Zorunlu kısımlar doldurulmalıdır.</h3>
                                  </div>
                                </div>"; 
                    }
                  } else {
                    $error = "<div class='card card-danger mt-3'>
                                <div class='card-header'>
                                  <h3 class='card-title'>Onay vermeden işlemi gerçekleştiremezsiniz.</h3>
                                </div>
                              </div>"; 
                  }
                }

              ?>
              <?php
                print $error;
              ?>
          </div><!-- /.card-body -->
          <!-- <div class="card-footer">Card footer</div> --> 
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
<script type="text/javascript">

  const getCellValue = (tr, idx) => tr.children[idx].innerText || tr.children[idx].textContent;

  const comparer = (idx, asc) => (a, b) => ((v1, v2) => 
      v1 !== '' && v2 !== '' && !isNaN(v1) && !isNaN(v2) ? v1 - v2 : v1.toString().localeCompare(v2)
      )(getCellValue(asc ? a : b, idx), getCellValue(asc ? b : a, idx));

  document.querySelectorAll('th').forEach(th => th.addEventListener('click', (() => {
    const table = th.closest('table');
    const tbody = table.querySelector('tbody');
    Array.from(tbody.querySelectorAll('tr'))
      .sort(comparer(Array.from(th.parentNode.children).indexOf(th), this.asc = !this.asc))
      .forEach(tr => tbody.appendChild(tr) );
          
  })));

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
