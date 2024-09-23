<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include ('../../controllator/General/Session.php');
include ('../../model/users/Worker.php');
include ('../../model/users/Assigned.php');
include ('../../model/clients/ClientModification.php');
include ('../../model/clients/Client.php');
include ('../../model/usersDB/SolChangeClientDB.php');
include ('../../model/DB/AdminConnDB.php');
include ('../../model/DB/CredentialsDB.php');
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
    include './header.php'; 
    $changesDB = new SolChangeClientDB();
    $solicitudes = $changesDB->getSolicitudes(AdminConnDB::getInstance()->getConnection());
    ?>
    <h1 class="gamer-title">Solicitudes de actualizacion de datos de clientes</h1>
    <div class="internal">
        <?php foreach ($solicitudes as $solicitud): ?>
        <div class="gamer-form div-centrado">
            <h2>Datos nuevos</h2>
            <p>Nombre: <?= $solicitud->getNewClient()->getName() ?></p>
            <p>Apellido: <?= $solicitud->getNewClient()->getLastname() ?></p>
            <p>Email: <?= $solicitud->getNewClient()->getEmail() ?></p>
            <hr>
            <h2>Datos actuales</h2>
            <p>Antiguo Nombre: <?= $solicitud->getOldClient()->getName() ?></p>
            <p>Antiguo Apellido: <?= $solicitud->getOldClient()->getLastname() ?></p>
            <p>Antiguo Email: <?= $solicitud->getOldClient()->getEmail() ?></p>
            <hr>
            <form action="" method="post">
                <input name="id" id="id" type="hidden" value="<?= $solicitud->getId() ?>">
                <button type="submit">Aprobar</button>
            </form>
            <br>
            <form action="" method="post">
                <input type="hidden" name="id" id="id" value="<?= $solicitud->getId() ?>">
                <button type="submit" style="background-color: #ff0000;"> Rechazar</button>
            </form>
        </div>
        <?php endforeach; ?>
    </div>

</body>
</html>