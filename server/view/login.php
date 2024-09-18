<?php 
    include ("../model/usersDB/UserDB.php");
    include ("../model/users/Worker.php");
    include ("../model/DB/UserInDB.php");
    require ("../model/DB/ConnectionDB.php");
    
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    //datos del formulario
    //$username = $_POST['username'];
    //$password = $_POST['password'];
    
    $connectionDB = new ConnectionDB();
    $conn = null;
    if($conn === null){
        $conn = $connectionDB->getConnection(ConnectionDB::CREDENTIALS['GUEST']);
    }
    if($conn != null){
        $userDB = new UserDB($conn);
        $worker = new Worker('admin', 'admin');
        echo "Se ha llegado al fin ";
        //echo $userDB->recoverRol($worker);
    } else {
        echo "<h1>No se pudo obtener la conexion</h1>";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <div class="internal">
        <h1 class="gamer-title">
            GamerProXela
        </h1>
    </div>
    <div class="gamer-form div-centrado">
        <h2>Inicio de sesión</h2>
        <form action="../controllator/services/LoginService.php" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Ingresar</button>
        </form>
    </div>
</body>
</html>