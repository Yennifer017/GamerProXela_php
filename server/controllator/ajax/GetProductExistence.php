<?php
include("../../model/products/Product.php");
include("../../model/products/Stock.php");
include("../../model/products/OnSale.php");
include("../../model/DB/CredentialsDB.php");
include("../../model/DB/InventaryConnDB.php");
include("../valitators/ProductValitator.php");
include("../General/Session.php");
include("../exceptions/InvalidDataEx.php");
include("../exceptions/NoDataFoundEx.php");
include("../../model/users/Worker.php");
include("../../model/users/Salesperson.php");
include("../../model/users/Assigned.php");
include("../../model/productsDB/ProductDB.php");
include("../../../model/DB/InventaryConnDB.php");  
error_reporting(E_ALL);
ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1);  

header('Content-Type: application/json'); 
$session = new Session();
$worker = $session->get_session_data();
if (isset($_GET['id']) && $worker != null && $worker->getRol() == Worker::INVENTARY_ROL) {
    try {
        $productId = $_GET['id'];
        $productId = (int) $productId;
        $productDB = new ProductDB();
        $idSucursal = (int) $worker->getIdSucursal();
        $product = new Stock($productId, $idSucursal);
        $product = $productDB->getProduct(
            $product, InventaryConnDB::getInstance()->getConnection());
        //convert to simple product for json pruporses
        $simpleProduct = [
            'name' => $product->getName(),
            'existences' => $product->getExistences(),
            'hall' => $product->getHall(),
        ];
        http_response_code(200); // OK
        echo json_encode($simpleProduct);
    } catch (PDOException $th) {
        http_response_code(400); // Bad Request
        echo json_encode(["error" => "ocurrio un error con la conexion con la base de datos"]);
    } catch (InvalidDataEx $th) {
        $error = $th->getMessage();
        http_response_code(400); // Bad Request
        echo json_encode(["error" => "Formato de datos invalido"]);
    } catch (NoDataFoundEx $th) {
        http_response_code(404); // not found
        echo json_encode(["error" => "Producto no encontrado"]);
    } catch (Exception $th) {
        http_response_code(500); 
        echo json_encode(["error" => "Error del servidor :c"]);
    }
}  else if ($worker == null || $worker->getRol() != Worker::INVENTARY_ROL){
    http_response_code(401); // Bad Request
    echo json_encode(["error" => "Credenciales invalidas."]);
} else {
    http_response_code(400); // Bad Request
    echo json_encode(["error" => "Faltan parámetros."]);
}
?>  