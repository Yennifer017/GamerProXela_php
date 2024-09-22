<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include ('../../controllator/General/Session.php');
include ('../../model/users/Worker.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../../assets/css/styles.css">
</head>
<body>
    <?php
    $session = new Session();
    $worker = $session->get_session_data();
    if($worker == null || $worker->getRol() != Worker::ADMIN_ROL){
        header('Location: ../login.php?e=401');
        exit();
    }
    ?>
    <?php 
    include './header.php'; 
    include 'reports.php';
    ?>
</body>
</html>