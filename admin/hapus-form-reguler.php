<?php

include("koneksi.php");
session_start();

if (isset($_GET['user_id'])) {
  $user_id = $_GET['user_id'];
  $sql = "DELETE FROM pendaftar_reguler WHERE user_id='$user_id'";
  if (mysqli_query($link, $sql)) {
      $_SESSION['success'] = "Data berhasil dihapus.";
  } else {
      $_SESSION['error'] = "Terjadi kesalahan saat menghapus Data.";
  }
  header("Location: pendaftar-reguler.php");
} else {
  header("Location: pendaftar-reguler.php");
}

?>