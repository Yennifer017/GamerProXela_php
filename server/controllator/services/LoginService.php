<?php 
include ("../model/usersDB/UserDB.php");
include ("../model/users/Worker.php");
include ("../model/DB/UserInDB.php");
require ("../model/DB/ConnectionDB.php");

error_reporting(E_ALL);
ini_set('display_errors', 1);

//datos del formulario
$username = $_POST['username'];
$password = $_POST['password'];

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