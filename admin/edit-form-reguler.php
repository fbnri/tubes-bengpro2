<?php

include("koneksi.php");
session_start();

if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM pendaftar_reguler WHERE user_id='$user_id' LIMIT 1";
$result = mysqli_query($link, $sql);

if (mysqli_num_rows($result) == 1) {
  $data = mysqli_fetch_assoc($result);
} else {
  // Jika tidak ada data, arahkan ke halaman lain atau tampilkan pesan kesalahan
  echo "Data tidak ditemukan";
  exit();
}

if(isset($_POST['edit'])) {
  $nama_siswa = $_POST['nama_siswa'];
  $ttl = $_POST['ttl'];
  $jk = $_POST['jk'];
  $alamat = $_POST['alamat'];
  $telp_siswa = $_POST['telp_siswa'];
  $agama = $_POST['agama'];
  $asal_sekolah = $_POST['asal_sekolah'];
  $ijazah = !empty($_FILES['ijazah']['name']) ? $_FILES['ijazah']['name'] : $data['ijazah'];
  $rapor = !empty($_FILES['rapor']['name']) ? $_FILES['rapor']['name'] : $data['rapor'];
  $prestasi = !empty($_FILES['prestasi']['name']) ? $_FILES['prestasi']['name'] : $data['prestasi'];
  $nama_ortu = $_POST['nama_ortu'];
  $pekerjaan = $_POST['pekerjaan'];
  $telp_ortu = $_POST['telp_ortu'];
  $pendidikan = $_POST['pendidikan'];

  // Simpan file yang diunggah
  if (!empty($_FILES['ijazah']['tmp_name'])) {
    move_uploaded_file($_FILES['ijazah']['tmp_name'], "../ijazah/" . $ijazah);
  }
  if (!empty($_FILES['rapor']['tmp_name'])) {
    move_uploaded_file($_FILES['rapor']['tmp_name'], "../rapor/" . $rapor);
  }
  if (!empty($_FILES['prestasi']['tmp_name'])) {
    move_uploaded_file($_FILES['prestasi']['tmp_name'], "../prestasi/" . $prestasi);
  }

  $sql = "UPDATE pendaftar_reguler SET nama_siswa='$nama_siswa', ttl='$ttl', jk='$jk', alamat='$alamat', telp_siswa='$telp_siswa', agama='$agama', asal_sekolah='$asal_sekolah', ijazah='$ijazah', rapor='$rapor', prestasi='$prestasi', nama_ortu='$nama_ortu', pekerjaan='$pekerjaan', telp_ortu='$telp_ortu', pendidikan='$pendidikan' WHERE user_id='$user_id'";

  if (mysqli_query($link, $sql)) {
    $_SESSION['success'] = "Data berhasil diubah!";
    header("Location: pendaftar-reguler.php");
    exit();
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($link);
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Dashboard 2</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="dist/img/logo-smktelkom.png" alt="SMK Telkom" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>
          <li class="nav-item">
            <a href="pendaftar-reguler.php">
              <button type="button" class="btn btn-warning btn-block">
              <i class="fas fa-chevron-left"></i>
                <span class="m-1"> Kembali</span> 
              </button>
            </a>
          </li>
        </ul>
        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
          <!-- Messages Dropdown Menu -->
          <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
              <i class="fas fa-expand-arrows-alt"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
              <i class="fas fa-th-large"></i>
            </a>
          </li>
        </ul>
      </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index2.php" class="brand-link">
      <img src="dist/img/logo-smktelkom.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Telkom Bandung</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $_SESSION["nama_lengkap"]; ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pendaftar</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user-friends"></i>
              <p>
                User
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="user-admin.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Admin</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item mt-lg-5">
            <a href="logout.php">
              <button type="button" class="btn btn-danger btn-group-sm">
                <span class="m-sm-1">Log Out</span> 
                <i class="fa fa-sign-out-alt"></i>
              </button>
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
            <h1 class="m-0"><strong>Pendaftaran SMK Telkom Bandung</strong></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Dashboard</li>
              <li class="breadcrumb-item active">Pendaftar Reguler</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
      <!-- <a href="tambah-angkatan.php">
        <button type="button" class="btn btn-info btn-group-sm">
          <i class="fa fa-plus"></i>
          <span class="m-sm-3">Tambah</span>
        </button>
      </a> -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
          <form action="" method="post" enctype="multipart/form-data">
            <div class="container-fluid">
              <!-- Info boxes -->
              <div class="row">
                <div class="col-md-12">
                  <div class="card card-secondary">
                    <div class="card-header">
                      <h3 class="card-title">Data Diri</h3>
        
                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                        </button>
                      </div>
                      <!-- /.card-tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <div class="card-body">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Nama Lengkap</label>
                          <input type="text" name="nama_siswa" value="<?= $data['nama_siswa'] ?>" class="form-control" id="exampleInputEmail1">
                        </div>
                        <div class="form-group">
                          <label>Tempat, Tanggal Lahir</label>
                          <div class="input-group date" id="reservationdate" data-target-input="nearest">
                            <input type="text" name="ttl" value="<?php echo $data['ttl'] ?>" class="form-control datetimepicker-input" data-target="#reservationdate"/>
                            <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label>Jenis Kelamin</label>
                          <div class="input-group">
                            <select class="form-control select1" name="jk">
                              <option disabled="disabled" selected="selected">Pilih</option>
                              <option value="laki-laki" <?php if($data['jk'] == "laki-laki") echo "selected"; ?>>Laki-Laki</option>
                              <option value="perempuan" <?php if($data['jk'] == "perempuan") echo "selected"; ?>>Perempuan</option>
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Alamat Lengkap</label>
                          <textarea class="form-control" name="alamat" id=""><?php echo $data['alamat'] ?></textarea>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">No. Telp/HP</label>
                          <input type="number" id="telp_siswa" maxlength="12" value="<?php echo $data['telp_siswa'] ?>" name="telp_siswa" class="form-control" id="exampleInputPassword1">
                        </div>
                        <div class="form-group">
                          <label>Agama</label>
                          <div class="input-group">
                            <select class="form-control select1" name="agama">
                              <option disabled="disabled" selected="selected">Pilih</option>
                              <option value="islam" <?php if($data['agama'] == "islam") echo "selected"; ?>>Islam</option>
                              <option value="protestan" <?php if($data['agama'] == "protestan") echo "selected"; ?>>Protestan</option>
                              <option value="katolik" <?php if($data['agama'] == "katolik") echo "selected"; ?>>Katolik</option>
                              <option value="hindu" <?php if($data['agama'] == "hindu") echo "selected"; ?>>Hindu</option>
                              <option value="buddha" <?php if($data['agama'] == "buddha") echo "selected"; ?>>Buddha</option>
                              <option value="konghucu" <?php if($data['agama'] == "konghucu") echo "selected"; ?>>Konghucu</option>
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Asal Sekolah</label>
                          <input type="text" name="asal_sekolah" value="<?php echo $data['asal_sekolah'] ?>" class="form-control" id="exampleInputPassword1">
                        </div>
                        <div class="form-group">
                          <label for="ijazahInputFile">Ijazah</label>
                          <div class="input-group">
                            <div class="custom-file">
                              <input type="file" name="ijazah" class="custom-file-input" id="ijazahInputFile" accept=".pdf">
                              <label class="custom-file-label" for="ijazahInputFile"><?php echo $data['ijazah'] ?></label>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="raporInputFile">Rapor</label>
                          <div class="input-group">
                            <div class="custom-file">
                              <input type="file" name="rapor" class="custom-file-input" id="raporInputFile" accept=".pdf">
                              <label class="custom-file-label" for="raporInputFile"><?php echo $data['rapor'] ?></label>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="prestasiInputFile">Prestasi</label>
                          <div class="input-group">
                            <div class="custom-file">
                              <input type="file" name="prestasi" class="custom-file-input" id="prestasiInputFile" accept=".pdf">
                              <label class="custom-file-label" for="prestasiInputFile"><?php echo $data['prestasi'] ?></label>
                            </div>
                          </div>
                        </div>
                      <!-- /.card-body -->
                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
                </div>
                <div class="col-md-12">
                  <div class="card card-secondary">
                    <div class="card-header">
                      <h3 class="card-title">Data Orang Tua</h3>
        
                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                        </button>
                      </div>
                      <!-- /.card-tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <div class="card-body">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Nama Lengkap Orang Tua/Wali</label>
                          <input type="text" name="nama_ortu" value="<?php echo $data['nama_ortu'] ?>" class="form-control" id="exampleInputEmail1">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Pekerjaan Orang Tua</label>
                          <input type="text" name="pekerjaan" value="<?php echo $data['pekerjaan'] ?>" class="form-control" id="exampleInputEmail1">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">No. Telp/HP Orang Tua/Wali</label>
                          <input type="number" id="telp_ortu" value="<?php echo $data['telp_ortu'] ?>" maxlength="12" name="telp_ortu" class="form-control" id="exampleInputPassword1">
                        </div>
                        <div class="form-group">
                          <label>Pendidikan Terakhir Orang Tua/Wali</label>
                          <div class="input-group">
                            <select class="form-control select1" name="pendidikan">
                              <option disabled="disabled" selected="selected">Pilih</option>
                              <option value="SD" <?php if($data['pendidikan'] == "SD") echo "selected"; ?>>SD</option>
                              <option value="SMP" <?php if($data['pendidikan'] == "SMP") echo "selected"; ?>>SMP</option>
                              <option value="SMA/SMK" <?php if($data['pendidikan'] == "SMA/SMK") echo "selected"; ?>>SMA/SMK</option>
                              <option value="D3" <?php if($data['pendidikan'] == "D3") echo "selected"; ?>>D3</option>
                              <option value="S1/D4" <?php if($data['pendidikan'] == "S1/D4") echo "selected"; ?>>S1/D4</option>
                              <option value="S2" <?php if($data['pendidikan'] == "S2") echo "selected"; ?>>S2</option>
                              <option value="S3" <?php if($data['pendidikan'] == "S3") echo "selected"; ?>>S3</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <!-- /.card-body -->
                    </div>
                    <!-- /.card-body -->
                  </div>
                  <div class="card-footer mb-4">
                    <button type="submit" name="edit" class="btn btn-success form-control">
                      <i class="fa fa-check"></i>
                    </button>
                  </div>
                  <!-- /.card -->
                </div>
              </div>
              <!-- /.row -->
            </div><!--/. container-fluid -->
          </form>
        </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <?php include("footer.php") ?>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
  $(function () {
    $('#example1').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": false,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
<!-- SweetAlert2 -->
<script src="plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- alert -->
<script>
  $(function() {
    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });

    $('.swalDefaultSuccess').click(function() {
      Toast.fire({
        icon: 'success',
        title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.swalDefaultInfo').click(function() {
      Toast.fire({
        icon: 'info',
        title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.swalDefaultError').click(function() {
      Toast.fire({
        icon: 'error',
        title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.swalDefaultWarning').click(function() {
      Toast.fire({
        icon: 'warning',
        title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.swalDefaultQuestion').click(function() {
      Toast.fire({
        icon: 'question',
        title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });

    $('.toastrDefaultSuccess').click(function() {
      toastr.success('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
    });
    $('.toastrDefaultInfo').click(function() {
      toastr.info('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
    });
    $('.toastrDefaultError').click(function() {
      toastr.error('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
    });
    $('.toastrDefaultWarning').click(function() {
      toastr.warning('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
    });

    $('.toastsDefaultDefault').click(function() {
      $(document).Toasts('create', {
        title: 'Toast Title',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultTopLeft').click(function() {
      $(document).Toasts('create', {
        title: 'Toast Title',
        position: 'topLeft',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultBottomRight').click(function() {
      $(document).Toasts('create', {
        title: 'Toast Title',
        position: 'bottomRight',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultBottomLeft').click(function() {
      $(document).Toasts('create', {
        title: 'Toast Title',
        position: 'bottomLeft',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultAutohide').click(function() {
      $(document).Toasts('create', {
        title: 'Toast Title',
        autohide: true,
        delay: 750,
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultNotFixed').click(function() {
      $(document).Toasts('create', {
        title: 'Toast Title',
        fixed: false,
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultFull').click(function() {
      $(document).Toasts('create', {
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.',
        title: 'Toast Title',
        subtitle: 'Subtitle',
        icon: 'fas fa-envelope fa-lg',
      })
    });
    $('.toastsDefaultFullImage').click(function() {
      $(document).Toasts('create', {
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.',
        title: 'Toast Title',
        subtitle: 'Subtitle',
        image: '../../dist/img/user3-128x128.jpg',
        imageAlt: 'User Picture',
      })
    });
    $('.toastsDefaultSuccess').click(function() {
      $(document).Toasts('create', {
        class: 'bg-success',
        title: 'Toast Title',
        subtitle: 'Subtitle',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultInfo').click(function() {
      $(document).Toasts('create', {
        class: 'bg-info',
        title: 'Toast Title',
        subtitle: 'Subtitle',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultWarning').click(function() {
      $(document).Toasts('create', {
        class: 'bg-warning',
        title: 'Toast Title',
        subtitle: 'Subtitle',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultDanger').click(function() {
      $(document).Toasts('create', {
        class: 'bg-danger',
        title: 'Toast Title',
        subtitle: 'Subtitle',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultMaroon').click(function() {
      $(document).Toasts('create', {
        class: 'bg-maroon',
        title: 'Toast Title',
        subtitle: 'Subtitle',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
  });
</script>
</body>
</html>
