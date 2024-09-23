<?php
class ClientModification{

    private int $id;
    private Client $oldClient;
    private Client $newClient;

    public function getId(): int{
        return $this->id;
    }
    public function getNewClient(): Client{
        return $this->newClient;
    }
    public function getOldClient(): Client{
        return $this->oldClient;
    }
    
    public function __construct(int $id, Client $oldClient, Client $newClient){
        $this->id = $id;
        $this->oldClient = $oldClient;
        $this->newClient = $newClient;
    }

}
    