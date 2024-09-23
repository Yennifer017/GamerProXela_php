<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de pasillo</title>
    <link rel="stylesheet" href="../../assets/css/styles.css">
</head>
<body>
    <?php include './header.php';?>
    <h1 class="gamer-title">Consulta de productos</h1>
    <div class="internal">
        <p class="paragraph-gamer">
            Los productos deben ser ingresados en el mismo pasillo en caso de ya estar en inventario.<br>
            Dicho pasillo se debe especificar.<br>
            De lo contrario, cualquier pasillo es aceptado por el sistema pero se debe consultar <br>
            su disponibilidad con el encargado de inventario.
        </p>
    </div>
    <div class="gamer-form div-centrado">
        <label for="id">Codigo del producto: </label>
        <input type="number" name="id" id="id">
        <button type="button" id="searchBtn">Buscar</button>
        <hr>
        <div>
            <p>Codigo: <span id="code"></span> </p>
            <p>Nombre: <span id="name"></span> </p>
            <p>Pasillo: <span id="hall"></span> <br></p>
        </div>  
    </div>
    <script src="../../assets/js/SearchHall.js"></script>
</body>
</html>