<?php
$cookie_path = '/';
$cookie_domain = ''; 

if (isset($_SERVER['HTTP_COOKIE'])) {
    $cookies = explode('; ', $_SERVER['HTTP_COOKIE']);
    foreach ($cookies as $cookie) {
        try {
            $parts = explode('=', $cookie);
            $name = trim($parts[0]);
            setcookie($name, '', time() - 3600, $cookie_path, $cookie_domain);
        } catch (Exception $e) {
        }
    }
}

header('Location: ../../view/login.php');
exit();
?>