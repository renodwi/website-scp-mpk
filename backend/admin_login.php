<?php
include "../config.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $token = $_POST['token'];

    if($token == "akselganteng123")
    {
        echo "Bener";
        $_SESSION['adminstatus'] = true;
    }
    else
    {
        echo "Salah";
    }
}
?>