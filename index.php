<?php 
include "config.php";
session_start();


if(!isset($_GET['page'])) $_GET['page'] = "login";
if(!isset($_SESSION['nis'])) $_SESSION['nis'] = "kosong";

if(isset($_GET['search_nis'])) $_GET['page'] = 'admin';

if(!isset($_SESSION['adminstatus'])) $_SESSION['adminstatus'] = false;

if(isset($_GET['logoutadmin'])) $_SESSION['adminstatus'] = false;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MPK SMANSADE</title>
    <link rel="stylesheet" href="./assets/css/output.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
        }
        @keyframes fade-in-up {
            0% {
                transform: translateY(40px);
                opacity: 0;
            }
            100% {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes fade-in {
            0% {
                transform: scale(0.9);
                opacity: 0;
            }
            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        .animate-fade-in-up {
            animation: fade-in-up 1s ease-out forwards;
        }

        .animate-fade-in {
            animation: fade-in 1s ease-out forwards;
        }

        .delay-150 {
            animation-delay: 0.15s;
        }

        .delay-300 {
            animation-delay: 0.3s;
        }
        .delay-600 {
            animation-delay: 0.6s;
        }
    </style>
</head>
<body class="bg-gray-100">
    <?php 
        require "./layout/header.php";

        if($_GET['page'] == "login")
        {
            require "./pages/login.php";
        }
        else if($_GET['page'] == "scpform")
        {
            require "./pages/scpform.php";
        }
        else if($_GET['page'] == "status")
        {
            require "./pages/status.php";
        }
        else if($_GET['page'] == "admin_login")
        {
            require "./pages/admin_login.php";
        }
        else if($_GET['page'] == "admin")
        {
            require "./pages/admin.php";
        }
        else if($_GET['page'] == "respon")
        {
            require "./pages/respon.php";
        }
        else
        {
            require "./pages/404_notfound.php";
        }

        require "./layout/footer.php";
    ?>
</body>
</html>