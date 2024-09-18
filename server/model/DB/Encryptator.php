<?php
class Encryptator {
    public function encrypt(Worker $worker) {
        $finalPassword = substr($worker->getUsername(), 0, 1) 
            . $worker->getPassword() 
            . substr($worker->getUsername(), -1);
        $hashedPassword = sha1($finalPassword);

        return $hashedPassword;
    }
}