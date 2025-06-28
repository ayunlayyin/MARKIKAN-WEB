<?php
$host = "localhost";
$user = "root";
$password = "";  // sesuaikan dengan password MySQL kamu
$dbname = "markikan";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
