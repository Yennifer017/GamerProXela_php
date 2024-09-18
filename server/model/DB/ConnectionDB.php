<?php
class ConnectionDB {
    public const CREDENTIALS = [
        'ADMIN' => ['username' => 'admingx', 'password' => 'admin123'],
        'GUEST' => ['username' => 'guestgx', 'password' => 'guest123'],
        'SALESPERSON' => ['username' => 'cajerogx', 'password' => 'cajero123'],
        'STOCK' => ['username' => 'bodegagx', 'password' => 'bodega123'],
        'INVENTARY' => ['username' => 'inventariogx', 'password' => 'invent123']
    ];

    const DB_NAME = 'gamer_pro_xela';
    const DB_HOST = 'localhost';
    const PORT = '5432';


    public function getConnection($userInDB) {
        $conn = null; 
        $port = ConnectionDB::PORT;
        $host = ConnectionDB::DB_HOST;
        $dbname = ConnectionDB::DB_NAME;
        $username = $userInDB['username'];
        $password = $userInDB['password'];
        $connStr = "host=$host port=$port dbname=$dbname user=$username password=$password";
        $conn = pg_connect($connStr);

        if ($conn) {
            return $conn;
        } else {
            echo "Conexión fallida, valor de retorno es null.";
            return null;
        }
    }
}