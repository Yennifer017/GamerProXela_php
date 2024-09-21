<?php
class Client{

    private int $id;
    private int $nit;
    private string $name;
    private string $lastname;
    private string $email;

    public function getId(): int{
        return $this->id;
    }
    public function getNit(): int{
        return $this->nit;
    }
    public function getName(): string{
        return $this->name;
    }
    public function getLastname(): string{
        return $this->lastname;
    }
    public function getEmail(): string{
        return $this->email;
    }

    public function setId(int $id){
        $this->id = $id;
    }
    
    public function __construct(int $nit, string $name, string $lastname, string $email, int $id = -1) {
        $this->nit = $nit;
        $this->name = $name;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->id = $id;
    }

}
    