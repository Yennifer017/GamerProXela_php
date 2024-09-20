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
        <?php 
        if (isset($_GET['e'])) {
            $status = $_GET['e'];
            switch ($status) {
                case 400:
                    echo '<div class="error-message"><p>Request invalido, intentalo otra vez</p></div>';
                    break;
                case 401:
                    echo '<div class="error-message"><p>Usuario o contrasena incorrectas</p></div>';
                    break;
                case 503:
                    echo '<div class="error-message"><p>Conexion a la base de datos invalida :c</p></div>';
                    break;
            }
        }
        ?>
    </div>
</body>
</html>