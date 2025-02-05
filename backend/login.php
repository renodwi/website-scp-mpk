<?php
include "../config.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $nis = $_POST['nis'];

    $sql = "SELECT * FROM `siswa` WHERE `nis` = '$nis'";
    $result = $conn->query($sql);

    if($result->num_rows)
    {
        $rows = $result->fetch_assoc();
        if($rows['status'] == 1)
        {
            $_SESSION['nis'] = $rows['nis'];
            echo "Telah Berpartisipasi";
        }
        else
        {
            $_SESSION['nis'] = $rows['nis'];
        }
    }
    else
    {
        echo "NIS Tidak Terdaftar";
    }
}
?>