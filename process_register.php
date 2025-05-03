<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $mysqli->prepare("INSERT INTO login (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $password);

    if ($stmt->execute()) {
        echo "Registrasi berhasil!";
        // Redirect ke halaman login
        header("Location: login.php");
    } else {
        echo "Terjadi error saat registrasi.";
    }
    $stmt->close();
}
?>
