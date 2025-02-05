<?php
include "../config.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];

    $sql = "DELETE FROM `pertanyaan` WHERE `id` = '$id'";
    if ($conn->query($sql) === TRUE) {
        echo "Berhasil";
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    header("Location: ./index.php");
}
?>