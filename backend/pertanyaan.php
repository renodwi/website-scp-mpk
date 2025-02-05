<?php 
include "../config.php";
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pertanyaan = $_POST["pertanyaan"];
    $bidang = $_POST["bidang"];
    $type = $_POST["type"];

    if (!empty($pertanyaan) && !empty($bidang) && !empty($type)) {
        $stmt = $conn->prepare("INSERT INTO pertanyaan (bidang, pertanyaan, type) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $bidang, $pertanyaan, $type);
        $stmt->execute();
        echo "<script>window.location.href = '../index.php?page=admin';</script>";
    }
}
?>