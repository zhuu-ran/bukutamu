<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$host = "localhost";
$user = "root";
$pass = "";
$database = "latihan";

$koneksi = new mysqli($host, $user, $pass);
$koneksi->set_charset("utf8mb4");
$koneksi->select_db($database);
?>