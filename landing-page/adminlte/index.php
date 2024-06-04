<?php

include("koneksi.php");
session_start();

$sql = "SELECT * FROM pendaftar_reguler";
$result = mysqli_query($link, $sql);

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
  <?php include("navbar.php") ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include("sidebar.php") ?>

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
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data Pendaftaran</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-hover">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Siswa</th>
                    <th>TTL</th>
                    <th>Jenis Kelamin</th>
                    <th>Alamat Lengkap</th>
                    <th>No. Telp/HP Siswa</th>
                    <th>Agama</th>
                    <th>Asal Sekolah</th>
                    <th>Ijazah</th>
                    <th>Rapor</th>
                    <th>Nama Ortu</th>
                    <th>Pekerjaan</th>
                    <th>No. Telp/HP Ortu</th>
                    <th>Pendidikan</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    while($data = mysqli_fetch_array($result)) :
                    ?>
                    <tr>
                      <td><?= $no ?></td>
                      <td><?= $data['nama_siswa'] ?></td>
                      <td><?= $data['ttl'] ?></td>
                      <td><?= $data['jk'] ?></td>
                      <td><?= $data['alamat'] ?></td>
                      <td><?= $data['telp_siswa'] ?></td>
                      <td><?= $data['agama'] ?></td>
                      <td><?= $data['asal_sekolah'] ?></td>
                      <td>
                        <?php
                        // Tautan unduh PDF
                        $pdfLink = "view_pdf.php?id=" . $data['id']; // Ganti 'id' dengan nama kolom yang menyimpan id pendaftar
                        ?>
                        <a href="<?= $pdfLink ?>" target="_blank">lihat PDF</a>
                      </td>
                      <td><?= $data['rapor'] ?></td>
                      <td><?= $data['nama_ortu'] ?></td>
                      <td><?= $data['pekerjaan'] ?></td>
                      <td><?= $data['telp_ortu'] ?></td>
                      <td><?= $data['pendidikan'] ?></td>
                    </tr>
                    <?php
                    $no++;
                    endwhile;
                    ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div><!--/. container-fluid -->
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
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.2.0
    </div>
  </footer>
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
</body>
</html>
