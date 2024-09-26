<?php
include("../../model/DB/CredentialsDB.php");
include ('../../controllator/General/Session.php');
include ('../../controllator/exceptions/NoDataFoundEx.php');
include ('../../model/users/Worker.php');
include ('../../model/users/Salesperson.php');

$session = new Session();
$worker = $session->get_session_data();
if ($worker == null || $worker->getRol() != Worker::SALESPERSON_ROL) {
    header('Location: ../login.php?e=401');
    exit();
}
include './header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Busqueda de productos</title>
    <link rel="stylesheet" href="../../assets/css/styles.css">
    <link rel="stylesheet" href="../../assets/css/tables.css">
</head>
<body>
    <h1 class="gamer-title">Busqueda de productos</h1>
    <div class="gamer-form div-centrado">
        <form action="#" method="POST" id="videogameForm">
            <label for="id">Nombre del videojuego: </label>
            <input type="text" name="name" id="name" required>
            <button type="submit">Consultar</button>
        </form>
    </div>
    <div>
        <table class="gamer-table">
            <thead>
                <tr>
                    <th>Codigo</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Existencias</th>
                    <th>Sucursal</th>
                </tr>
            </thead>
            <tbody id="productsTbody">
                <!--add products here -->
            </tbody>
        </table>
    </div>
    <script src="../../assets/js/SearchProduct.js"></script>
</body>
</html>