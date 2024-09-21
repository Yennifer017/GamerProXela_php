<?php
class ClientValitator {
  
    public function isValid(Client $client) {
        return is_int($client->getNit()) 
            && !empty($client->getName()) 
            &&  !empty($client->getLastname())
            && !empty($client->getEmail()) && filter_var($client->getEmail(), FILTER_VALIDATE_EMAIL);
    }

    public function hasChange(Client $client){
        return !empty($client->getName()) 
            || !empty($client->getLastname()) 
            || !empty($client->getEmail());
    }

    public function isValidChange(Client $client){
        return is_int($client->getNit()) 
            && (empty($client->getEmail()) ? true : filter_var($client->getEmail(), FILTER_VALIDATE_EMAIL));
    }

}