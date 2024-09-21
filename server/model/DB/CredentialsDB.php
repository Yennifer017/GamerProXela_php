<?php
class CredentialsDB {
    public const CREDENTIALS = [
        'ADMIN' => ['username' => 'admingx', 'password' => 'admin123'],
        'GUEST' => ['username' => 'guestgx', 'password' => 'guest123'],
        'SALESPERSON' => ['username' => 'cajerogx', 'password' => 'cajero123'],
        'STOCK' => ['username' => 'bodegagx', 'password' => 'bodega123'],
        'INVENTARY' => ['username' => 'inventariogx', 'password' => 'invent123']
    ];

    public const DB_NAME = 'gamer_pro_xela';
    public const DB_HOST = 'localhost';
    public const PORT = '5432';
}