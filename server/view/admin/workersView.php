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
    <title>Empleados</title>
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

    if (isset($_GET['e'])) {
        $status = $_GET['e'];
        switch ($status) {
            case 200:
                echo '<div class="success-message"><p>Trabajador registrado correctamente</p></div>';
                break;
            case 400:
                echo '<div class="error-message"><p>Formato de datos invalido, intentalo otra vez</p></div>';
                break;
            case 503:
                echo '<div class="error-message"><p>
                        Username repetido, sucursal invalida o error de conexion con la base de datos
                    </p></div>';
                break;
            case 500:
                echo '<div class="error-message"><p>Error inesperado, intentalo de nuevo</p></div>';
                break;
        }
    }

    ?>
    <h1 class="gamer-title">Registro de Empleado</h1>
    <div class="gamer-form div-centrado">
        <form action="../../controllator/services/adminSer/AddWorkerSer.php" method="POST">
            <label for="username">Username: </label>
            <input type="text" name="username" id="username">

            <label for="password">Contrasena: </label>
            <input type="password" name="password" id="password">

            <label for="sucursal">Codigo de sucursal </label>
            <input type="number" name="sucursal" id="sucursal">

            <label for="type">Tipo de Empleado: </label>
            <select name="type" id="type">
                <option value="<?php echo Worker::SALESPERSON_ROL ?>">Cajero</option>
                <option value="<?php echo Worker::INVENTARY_ROL ?>">Encargado de inventario</option>
                <option value="<?php echo Worker::STOCK_ROL ?>">Encargado de bodega</option>
            </select>
            <hr>
            <label for="checkout">Caja Relacionada (solo para cajeros):</label>
            <input type="number" name="checkout" id="checkout">
            <button type="submit">Agregar empleado</button>
        </form>
    </div>
</body>
</html>