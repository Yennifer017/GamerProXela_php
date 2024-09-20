<h1>Bienvenido usuario:
    <?php
        if (isset($_COOKIE["username"])) {
            echo "<b>" . $_COOKIE["username"] . "<b>";
        } else {
            echo "<b>IMPOSTOR >:(</b>";
        }
    ?>
</h1>