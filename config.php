<?php
$conn = mysqli_connect("localhost", "root", "", "mpk_scp");
// $conn = mysqli_connect("localhost", "root", "", "pesdesis_pesdeka");

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>