<?php 
include "../config.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST["nama"];
    $kelas = $_POST["kelas"];
    $kelaske = $_POST["kelaske"];
    $nis = $_POST["nis"];

    if (!empty($nama) && !empty($kelas) && !empty($kelaske) && !empty($nis)) {
        $stmt = $conn->prepare("INSERT INTO siswa (nama, kelas, kelaske, nis) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("siii", $nama, $kelas, $kelaske, $nis);
        $stmt->execute();
        echo "Berhasil";
    } else {
        echo $conn->error;
    }
}
?>