<?php
$conn = mysqli_connect("localhost", "u626944758_mpkscp_data", "k3=O?X!A", "u626944758_mpkscp_user");

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>