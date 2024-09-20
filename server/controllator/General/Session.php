<?php
class Session {
    private const PASS_PHRASE = '-----i-amnt-the-best------';
    public const SESSION_COOKIE_NAME = 'session';
    private const SEPARATOR = ',';
    public const USERNAME_COOKIE_NAME = "username";

    public function setSimpleSessionCookie(Worker $worker){
        $random = rand(0, 10000);
        $cookie = $worker->getId() . Session::SEPARATOR . $worker->getRol() . Session::SEPARATOR . $random;
        $cookie = $this->makeup_data($cookie);
        $this->set_cookie(Session::SESSION_COOKIE_NAME, $cookie);
    }

    public function setSessionCookie(Assigned $assigned){
        $random = rand(0, 10000);
        $cookie = $assigned->getId() . Session::SEPARATOR 
            . $assigned->getRol() . Session::SEPARATOR 
            . $assigned->getIdSucursal() . Session::SEPARATOR 
            . $random;
        $cookie = $this->makeup_data($cookie);
        $this->set_cookie(Session::SESSION_COOKIE_NAME, $cookie);
    }

    public function setAllSessionCookie(Salesperson $worker){
        $random = rand(0, 10000);
        $cookie = $worker->getId() . Session::SEPARATOR 
            . $worker->getRol() . Session::SEPARATOR 
            . $worker->getIdSucursal() . Session::SEPARATOR 
            . $worker->getNoCheckout() . Session::SEPARATOR 
            . $random;
        $cookie = $this->makeup_data($cookie);
        $this->set_cookie(Session::SESSION_COOKIE_NAME, $cookie);
    }

    public function set_cookie($name, $value){
        $expiracion = time() + (86400 * 30);
        setcookie($name, $value, $expiracion, "/");
    }

    private function makeup_data($data) {
        $method = 'aes-256-cbc'; // Método de cifrado
        $key = hash('sha256', Session::PASS_PHRASE, true);
        $iv = openssl_random_pseudo_bytes(16); 
        $encrypted = openssl_encrypt($data, $method, $key, 0, $iv); 
        return base64_encode($iv . $encrypted);
    }

    public function get_session_data() {
        if (isset($_COOKIE['session'])) {
            $encryptedData = $_COOKIE['session'];
            $method = 'aes-256-cbc'; // Método de cifrado
            $key = hash('sha256', Session::PASS_PHRASE, true); // Derivar la misma clave de la frase de contraseña
            $data = base64_decode($encryptedData); // Decodificar desde base64
            $iv = substr($data, 0, 16); // Extraer el IV de los primeros 16 bytes
            $encrypted = substr($data, 16); // Extraer el texto cifrado
            $data = openssl_decrypt($encrypted, $method, $key, 0, $iv); // Descifrar los datos
            try {
                $array = explode(Session::SEPARATOR, $data);
                switch (count($array)) {
                    case 3:
                        return new Worker(null, null, $array[0], $array[1]);
                    case 4:
                        return new Assigned(null, null, $array[0], $array[1], $array[2]);
                    case 5:
                        return new Salesperson(null, null, $array[0], $array[2], $array[3]);
                    default:
                        return null;
                }
            } catch (Exception $e) {
                return null;
            }
        } else {
            return null;
        }
    }
    
}