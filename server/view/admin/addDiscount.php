<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('../../controllator/General/Session.php');
include('../../model/users/Worker.php');
include('../../model/users/Assigned.php');
include('../../model/clients/ClientModification.php');
include('../../model/clients/Client.php');
include('../../model/usersDB/SolChangeClientDB.php');
include('../../model/DB/AdminConnDB.php');
include('../../model/DB/CredentialsDB.php');

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
    if ($worker == null || $worker->getRol() != Worker::ADMIN_ROL) {
        header('Location: ../login.php?e=401');
        exit();
    }
    include './header.php';
    if (isset($_GET['e'])) {
        $status = $_GET['e'];
        switch ($status) {
            case 200:
                echo '<div class="success-message"><p>Descuento agregado</p></div>';
                break;
            case 400:
                echo '<div class="error-message"><p>Formato de datos invalido, intentalo otra vez</p></div>';
                break;
            case 503:
                echo '<div class="error-message"><p>
                        El descuento ya existe / error de la base de datos
                    </p></div>';
                break;
            case 500:
                echo '<div class="error-message"><p>Error inesperado, intentalo de nuevo</p></div>';
                break;
        }
    }
    ?>
    <h1 class="gamer-title">Agregar descuento</h1>
    <div class="gamer-form div-centrado">
        <form action="../../controllator/services/adminSer/AddDiscountSer.php" method="post">
            <label for="idProduct">Codigo del producto: </label>
            <input type="number" name="idProduct" id="idProduct" required>

            <label for="percentaje">Porcentaje: </label>
            <input type="number" name="percentaje" id="percentaje" required>

            <label for="dateInit">Valido desde: </label>
            <input type="date" name="dateInit" id="dateInit" required>

            <label for="dateEnd">Valido hasta: </label>
            <input type="date" name="dateEnd" id="dateEnd" required>
            
            <button type="submit">Agregar</button>
        </form>
    </div>

</body>

</html>