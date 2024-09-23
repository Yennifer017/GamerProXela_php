<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include ('../../controllator/General/Session.php');
include ('../../model/users/Worker.php');
include ('../../model/users/Salesperson.php')
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes</title>
    <link rel="stylesheet" href="../../assets/css/styles.css">
</head>
<body>
    <?php
    $session = new Session();
    $worker = $session->get_session_data();
    if($worker == null || $worker->getRol() != Worker::SALESPERSON_ROL){
        header('Location: ../login.php?e=401');
        exit();
    }
    ?>
    <?php 
    include './header.php'; 
    if (isset($_GET['e'])) {
        $status = $_GET['e'];
        switch ($status) {
            case '200c':
                echo '<div class="success-message"><p>Cliente registrado correctamente</p></div>';
                break;
            case '400c':
                echo '<div class="error-message"><p>Informacion del cliente invalida</p></div>';
                break;
        }
    }
    ?>
    <h1>TARJETAS</h1>
    <div class="gamer-form">
        
    </div>

</body>
</html>