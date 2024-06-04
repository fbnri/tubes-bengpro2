<?php
include("koneksi.php");
session_start();

// Ambil ID pendaftar dari URL
$id = $_GET['id'];

// Query untuk mendapatkan data pendaftar berdasarkan ID
$sql = "SELECT ijazah FROM pendaftar_reguler WHERE id = $id"; // Ganti 'pdf_field' dengan nama kolom yang menyimpan file PDF dalam bentuk BLOB
$result = mysqli_query($link, $sql);
$data = mysqli_fetch_assoc($result);

// Header untuk menentukan tipe konten (PDF)
header("Content-type: application/pdf");

// Tampilkan file PDF
echo $data['ijazah']; // Ganti 'pdf_field' dengan nama kolom yang menyimpan file PDF dalam bentuk BLOB
?>
