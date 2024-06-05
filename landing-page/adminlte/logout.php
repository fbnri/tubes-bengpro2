<?php
session_start();
session_destroy();
$_SESSION['success'] = "Berhasil Logout";
header("Location: login.php");
exit;
?>