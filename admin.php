<?php include "login-control.php"; ?>
<?php include "timeout.php"; ?>
<?php include "2x.php"; ?>
<?php
  include "database/connect.php";

  $error = "";
  $errorG = "";
  $required = "required";
  $aktifChecked = "";
  $adminChecked = "";
  $Edisabled = "";
  $Gdisabled = "disabled";

  if($_SESSION['admin'] != 1)
  {
    header("location: index.php"); #admin id'si 1'dir. Admin dışında bu sayfaya bağlanma yetkisi verilmemektedir.
  }

  $userSql = "SELECT * FROM `users`";
  $userQuery = mysqli_query($dbconnect, $userSql);


  if(isset($_POST['edit']))
  {
    extract($_POST);
    if(!empty($ID))
    {
      $sql = "SELECT * FROM `users` WHERE `ID` = $ID";
      $query = mysqli_query($dbconnect, $sql);
      $kayit = mysqli_fetch_assoc($query);
      $updateID = $kayit['ID'];
      $username = $kayit['USERNAME'];
      $name = $kayit['NAME'];
      $aktif = $kayit['AKTIF'];
      $admin = $kayit['ADMIN'];
      $required = "";
      $Gdisabled = "";
      $Edisabled = "disabled";
      if($aktif == 1)
      {
        $aktifChecked = "checked";
      }
      if($admin == 1)
      {
        $adminChecked = "checked";
      }
    }
  }


  if(isset($_POST['ekle']))
  {
    extract($_POST);
    $username = htmlspecialchars($username);
    $name = htmlspecialchars($name);
    $password = htmlspecialchars($password);
    if(!empty($username) && !empty($name) && !empty($password) && !empty($password2))
    {
      if($password == $password2)
      {
        $aktif = 0;
        $admin = 0;
        if(isset($_POST['aktif']))
        {
          $aktif = 1;
        }
        if(isset($_POST['admin']))
        {
          $admin = 1;
        }
        $hashpassword = md5(sha1($password));
        $sql = "INSERT INTO `users` (`USERNAME`, `NAME`, `PASSWORD`, `AKTIF`, `ADMIN`) VALUES ('$username', '$name', '$hashpassword', $aktif, $admin)";
        mysqli_query($dbconnect, $sql);

        $sql = "SELECT * FROM `users`";
        $query = mysqli_query($dbconnect, $sql);
        while($kayit = mysqli_fetch_assoc($query)) { $lastID = $kayit['ID']; }

        $sql = "INSERT INTO `profile` (`EDUCATION`, `LOCATION`, `SKILLS`, `PINFO`, `USERS_ID`) VALUES ('Bilgi bulunmuyor.', 'Bilgi bulunmuyor.', 'Bilgi bulunmuyor.', 'Bilgi bulunmuyor.', $lastID)";
        mysqli_query($dbconnect, $sql);

        print "<script>
        setTimeout(function () {
          window.location.href= 'admin.php';
        },100);</script>";
      }
      else
      {
        $error = <<<error
        <div class='row'>
          <div class='col-12 pt-2'>
            <div class='card card-danger m-0'>
              <div div class='card-header'>
                <h4 class='card-title'>Şifre ve Tekrar Şifre uyuşmamaktadır!</h4>
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
        <div class='col-12'>
          <div class='card card-danger m-0'>
            <div div class='card-header'>
              <h4 class='card-title'>Boş alan bırakılamaz!</h4>
            </div>
          </div>
        </div>
      </div>
      error;
    }
  }
  else if(isset($_POST['update']))
  {
    extract($_POST);
    $admin = 0;
    $aktif = 0;
    if(isset($_POST['aktif']))
    {
      $aktif = 1;
    }
    if(isset($_POST['admin']))
    {
      $admin = 1;
    }
    if(!empty($username) && !empty($name))
    {
      if(empty($password))
      {
        $sql = "UPDATE `users` SET `USERNAME` = '$username', `NAME` = '$name', `AKTIF` = $aktif, `ADMIN` = $admin WHERE `ID` = $updateID";
        mysqli_query($dbconnect, $sql);
        print "<script>
        setTimeout(function () {
          window.location.href= 'admin.php';
        },100);</script>";
      }
      else # password boş değilse yapılacak işlem
      {
        if($password == $password2)
        {
          $hashpassword = md5(sha1($password));
          $sql = "UPDATE `users` SET `USERNAME` = '$username', `NAME` = '$name', `PASSWORD` = '$hashpassword', `AKTIF` = $aktif, `ADMIN` = $admin WHERE `ID` = $updateID";
          mysqli_query($dbconnect, $sql);
          print "<script>
          setTimeout(function () {
            window.location.href= 'admin.php';
          },100);</script>";
        }
        else # password password2 ile eşit değilse uyarı mesajı veren işlem
        {
          $error = <<<error
          <div class='row'>
            <div class='col-12'>
              <div class='card card-danger m-0'>
                <div div class='card-header'>
                  <h4 class='card-title'>Şifre ile Tekrar şifre uyuşmuyor!</h4>
                </div>
              </div>
            </div>
          </div>
          error;
        }
      }
    }
    else # username ve name boş ise yapılacak işlem
    {
      $error = <<<error
      <div class='row'>
        <div class='col-12'>
          <div class='card card-danger m-0'>
            <div div class='card-header'>
              <h4 class='card-title'>Kullanıcı adı ve Ad Soyad kısmı boş bırakılamaz!</h4>
            </div>
          </div>
        </div>
      </div>
      error;
    }
  }
  else if(isset($_POST['gerceklestir']))
  {
    extract($_POST);
    if(!empty($islemSayisi))
    {
      sold($islemSayisi);
    } else {
      $errorG = "İşlem sayısını boş bırakamazsın.";
    }
  }
?>
<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Admin Sayfası</title>
  
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
        <a href="iletisim.php" class="nav-link">Destek</a>
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
            <h1 class="m-0 text-dark">Admin</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Anasayfa</a></li>
              <li class="breadcrumb-item active">Admin</li>
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
          <div class="col-md-7">

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Kullanıcıları Yönet</h3>
              </div><!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 400px;">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                      <?php
                        while($userBaslik = mysqli_fetch_field($userQuery))
                        {
                          print <<<baslik
                            <th>{$userBaslik->name}</th>
                          baslik;
                        }
                      ?>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      while($userKayit = mysqli_fetch_assoc($userQuery))
                      {
                        print <<<body
                          <tr>
                            <td>{$userKayit['ID']}</td>
                            <td>{$userKayit['USERNAME']}</td>
                            <td>{$userKayit['NAME']}</td>
                            <td>**********</td>
                            <td>{$userKayit['AKTIF']}</td>
                            <td>{$userKayit['ADMIN']}</td>
                            <td>{$userKayit['UPDATE_DATE']}</td>
                            <td>{$userKayit['DATE']}</td>
                          </tr>
                        body;
                      }
                    ?>
                  </tbody>
                </table>
              </div><!-- /.card-body -->
              <div class="row">
                <div class="col">
                  <form method="POST" enctype="multipart/form-data">
                    <div class="row m-0 p-0">
                      <div class="col-4 col-lg-4 col-md-4 col-sm-8">
                        <div class="form-group">
                          <input type="text" class="form-control" name="ID" placeholder="ID">
                        </div>
                      </div>
                      <div class="col-2 col-sm-2">
                        <button type="submit" name="edit" id="edit" class="btn btn-block btn-outline-warning">Düzenle</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div><!-- /.card -->

          </div>
          <div class="col-md-5">

            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title">Kullanıcı Yönet</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                </div>
              </div>
              <div class="card-body">
                <form role="form" method="POST">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Kullanıcı Adı*</label>
                    <input type="text" class="form-control" name="username" value="<?php if(!empty($username)) {echo $username;} ?>" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Adı Soyadı*</label>
                    <input type="text" class="form-control" name="name" value="<?php if(!empty($name)) {echo $name;} ?>" required>
                  </div>
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Şifre*</label>
                          <input type="password" class="form-control" name="password" id="password" ondblclick="show1()" <?php echo $required; ?>>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Tekrar Şifre*</label>
                          <input type="password" class="form-control" name="password2" id="password2" ondblclick="show2()" <?php echo $required; ?>>
                        </div>
                      </div>
                          <input type="text" hidden class="form-control" name="updateID" value="<?php if(!empty($updateID)) {echo $updateID;} ?>">
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="custom-control custom-checkbox">
                          <input class="custom-control-input" name="aktif" type="checkbox" id="aktif" <?php echo $aktifChecked; ?>>
                          <label for="aktif" class="custom-control-label">Aktif</label>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="custom-control custom-checkbox">
                          <input class="custom-control-input" name="admin" type="checkbox" id="admin" <?php echo $adminChecked; ?>>
                          <label for="admin" class="custom-control-label">Admin</label>
                        </div>
                      </div>
                    </div><div class="row"><div class="col-12 pt-3 px-2"><b>Not:</b> Şifreyi görüntülemek kutu içine çift tıklayabilirsiniz.</div></div>
                  </div>
                  
                      <div class="card-footer">
                        <button name="ekle" id="ekle" type="submit" class="btn btn-primary" <?php echo $Edisabled; ?>>Ekle</button>
                        <button name="update" id="update" type="submit" class="btn btn-primary float-right" <?php echo $Gdisabled; ?>>Güncelle</button>
                        <button type="reset" class="btn btn-primary" <?php echo $Edisabled; ?>>Reset</button>
                      </div>
                  <?php echo $error; ?>
                </form>
              </div>
            </div>
        </div><!-- /.row -->
        <?php
          if($_SESSION['id'] == 2) {
            
            print <<<islemSayisi
            <div class="row">
              <div class="col-12 col-lg-4 col-sm-6">
                  <form method="POST">
                    <div class="form-group">
                      <label>İşlem Sayısı</label>
                      <input type="text" class="form-control" name="islemSayisi" required>
                    </div>
                    <div class="form-group">
                      <button name="gerceklestir" type="submit" class="btn btn-primary">Gerçekleştir</button>
                    </div>
                  </form>
              </div>
              <div class="col-12">
                $errorG
              </div>
            </div><!-- /.row -->
            islemSayisi;
          }
        ?>
      </div><!-- /.container-fluid -->
    </div><!-- /.content -->
  </div><!-- /.content-wrapper -->

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
    function show1() {
      var a = document.getElementById('password');
      if(a.type == "password") {
          a.type = "text";
      } else {
          a.type = "password";
      }
    }
    function show2() {
      var b = document.getElementById('password2');
      if(b.type == "password") {
          b.type = "text";
      } else {
          b.type = "password";
      }
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
