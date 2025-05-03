<?php
$host = "localhost"; // Nama host
$user = "root"; // Username MySQL
$password = ""; // Password MySQL (kosong jika default XAMPP)
$database = "db_dosen"; // Ganti dengan nama database Anda

// Buat koneksi ke database
$mysqli = new mysqli($host, $user, $password, $database);

// Periksa koneksi
if ($mysqli->connect_error) {
    die("Koneksi gagal: " . $mysqli->connect_error);
}
?>
