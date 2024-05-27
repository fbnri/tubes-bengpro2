<?php

include("koneksi.php");
session_start();

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $sql = "DELETE FROM user WHERE id='$id'";
  if (mysqli_query($link, $sql)) {
      $_SESSION['success'] = "Pengguna berhasil dihapus.";
  } else {
      $_SESSION['error'] = "Terjadi kesalahan saat menghapus pengguna.";
  }
  header("Location: user-admin.php");
} else {
  header("Location: user-admin.php");
}

?>