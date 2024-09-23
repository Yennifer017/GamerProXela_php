<?php
class Card{
    private CardCategory $category;
    private $acummulatedMoney;
    private int $points;

    public function getCardCategory(): CardCategory{
        return $this->category;
    }
    public function getAccumulatedMoney(): int{
        return $this->acummulatedMoney;
    }
    public function getPoints(): int{
        return $this->points;
    }
    public function setCardCategory(CardCategory $category){
        $this->category = $category;
    }
    public function setAccumulatedMoney(int $amount){
        $this->acummulatedMoney = $amount;
    }
    public function setPoints(int $amount){
        $this->points = $amount;
    }

    public function __construct(int $acummulatedMoney = 0, int $points = 0, CardCategory $category = null){
        $this->acummulatedMoney = (int) $acummulatedMoney;
        $this->points = $points;
        $this->category = $category;
    }
    public function canUpdate(){
        if($this->category != null){
            return $this->acummulatedMoney >= $this->category->getValueToUpgrate();
        }
        return false;
    }

}
    