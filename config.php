<?php
/* $conn = mysqli_connect("localhost", "root", "", "mpk_scp"); */
$conn = mysqli_connect("localhost", "u626944758_mpkscp", "Mpk12345", "u626944758_mpkscp");

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>