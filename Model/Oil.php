<?php
require_once 'FoodSetDecorator.php';
class Oil extends FoodSetDecorator
{

    public function __construct(FoodSet $foodSet, float $price)
    {
        $this->foodset = $foodSet;
        $this->description = "Oil";
        $this->cost = $price;
    }


    public function updataItemCost(float $price): bool
    {

        $this->cost = $price;

        return true;
    }

    public function getCost(): int
    {
        return  $this->foodset->getCost() + $this->cost;
    }
    public function getItems(): string
    {
        return $this->foodset->getItems() . ", " . $this->description;
    }
}
