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
            case '503c':
                echo '<div class="error-message"><p>Nit duplicado o error con la conexion</p></div>';
                break;
        }
    }
    ?>

    <div class="accordion div-centrado">
        <!-- Item 1 -->
        <div class="accordion-item">
            <input type="radio" id="item1" name="accordion" />
            <label class="accordion-title" for="item1">Agregar Cliente</label>
            <div class="accordion-content">
                <div class="gamer-form div-centrado">
                    <form action="../../controllator/services/salespersonSer/AddClientService.php" method="post">
                        <label for="nit">Nit: </label>
                        <input type="number" name="nit" id="nit" required>

                        <label for="name">Nombre: </label>
                        <input type="text" name="name" id="name" required>

                        <label for="lastname">Apellido: </label>
                        <input type="text" name="lastname" id="lastname" required>

                        <label for="email">Correo electronico:</label>
                        <input type="email" name="email" id="email" required>
                        <br><br>
                        <button type="submit">Agregar</button>
                    </form>
                </div>    
            </div>
        </div>

        <!-- Item 2 -->
        <div class="accordion-item">
            <input type="radio" id="item2" name="accordion" />
            <label class="accordion-title" for="item2">Modificar Cliente</label>
            <div class="accordion-content">
                <div class="gamer-form div-centrado">
                    <form action="../../controllator/services/salespersonSer/AddClientService.php" method="post">
                        <label for="nit">Nit: </label>
                        <input type="number" name="nit" id="nit" required>

                        <label for="name">Nombre: </label>
                        <input type="text" name="name" id="name">

                        <label for="lastname">Apellido: </label>
                        <input type="text" name="lastname" id="lastname">

                        <label for="email">Correo electronico:</label>
                        <input type="email" name="email" id="email">
                        <br><br>
                        <button type="submit">Agregar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
</html>