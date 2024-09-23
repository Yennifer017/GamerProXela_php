<?php
class CardCategory{
    private int $id;
    private string $name;
    private $valueToUpgrate;
    private int $pointsToAdd;

    public function getId(): int{
        return $this->id;
    }
    public function getName(): string{
        return $this->name;
    }
    public function getValueToUpgrate(){
        return $this->valueToUpgrate;
    }
    public function getPointsToAdd(): int{
        return $this->pointsToAdd;
    }

    public function setId(int $id){
        $this->id = $id;
    }
    public function setName(string $name){
        $this->name = $name;
    }
    public function setValueToUpgrate($valueToUpgrate){
        $this->valueToUpgrate = $valueToUpgrate;
    }
    public function setPointsToAdd(int $pointsToAdd){
        $this->pointsToAdd = $pointsToAdd;
    }

    public function __construct(string $name = '', int $valueToUpgrate = 0, int $pointsToAdd = 0, int $id = 0){
        $this->id = $id;
        $this->name = $name;
        $this->valueToUpgrate = $valueToUpgrate;
        $this->pointsToAdd = $pointsToAdd;
    }


}
    