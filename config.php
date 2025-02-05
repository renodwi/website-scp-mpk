<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$conn = mysqli_connect("localhost", "u626944758_mpkscp_user", "k3=O?X!A", "u626944758_mpkscp_data");
/* $conn = mysqli_connect("localhost", "root", "", "mpk_scp"); */

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>