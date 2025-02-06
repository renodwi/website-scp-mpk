<?php 
include "../config.php";
session_start();
$nis = $_SESSION['nis']; // Anda perlu menambahkan input NIS di form

$kritik_mpk = $_POST['Kritik_Mpk'];
$saran_mpk = $_POST['Saran_Mpk'];
$kritik_osis = $_POST['Kritik_Osis'];
$saran_osis = $_POST['Saran_Osis'];

$sql = "INSERT INTO pertanyaan_respon (nis, bidang, pertanyaan, type, rating, alasan) VALUES (?, ?, ?, ?, ?, ?)";

// Persiapkan statement
$stmt = $conn->prepare($sql);

// Bind parameter
$stmt->bind_param("isssis", $nis, $bidang, $pertanyaan, $type, $rating, $alasan);

// Data yang akan dimasukkan
$data = [
    [$nis, 'Kritik MPK', 'Kritik MPK', 1, 1, $kritik_mpk],
    [$nis, 'Saran MPK', 'Saran MPK', 1, 1, $saran_mpk],
    [$nis, 'Kritik OSIS', 'Kritik OSIS', 1, 1, $kritik_osis],
    [$nis, 'Saran OSIS', 'Saran OSIS', 1, 1, $saran_osis],
];

// Eksekusi query untuk setiap data
foreach ($data as $row) {
    list($nis, $bidang, $pertanyaan, $type, $rating, $alasan) = $row;
    $stmt->execute();
}

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