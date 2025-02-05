<?php 
include "../config.php";
session_start();
$nis = $_SESSION['nis']; // Anda perlu menambahkan input NIS di form
foreach ($_POST as $key => $value) {
    if (strpos($key, 'pertanyaan_') === 0) {
        $id = str_replace('pertanyaan_', '', $key);
        $rating = $value;
        $alasan = $_POST['alasan_' . $id] ?? '';

        // Ambil data pertanyaan dari database
        $sql = "SELECT * FROM pertanyaan WHERE id = $id";
        $result = $conn->query($sql);
        $pertanyaan = $result->fetch_assoc();

        // Simpan respon ke database
        $stmt = $conn->prepare("INSERT INTO pertanyaan_respon (nis, bidang, pertanyaan, type, rating, alasan) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssiis", $nis, $pertanyaan['bidang'], $pertanyaan['pertanyaan'], $pertanyaan['type'], $rating, $alasan);
        $stmt->execute();

        $stmt = $conn->prepare("UPDATE siswa SET `status` = '1' WHERE `nis` = '".$nis."'");
        $stmt->execute();
    }

    echo "<script>window.location.href = '../index.php?page=status';</script>";
}
?>