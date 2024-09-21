<?php
class ClientValitator {
  

    public function isValid(Client $client) {
        return is_int($client->getNit()) 
            && !empty($client->getName()) 
            &&  !empty($client->getLastname())
            && !empty($client->getEmail()) && filter_var($client->getEmail(), FILTER_VALIDATE_EMAIL);
    }


}