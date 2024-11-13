<?php
require_once 'FoodSet.php';
    abstract class FoodSetDecorator extends FoodSet{
            protected FoodSet $foodset;
            
        
            abstract public function getCost():int ;
            abstract public function setFoodSet ():bool;
            abstract public function updataFoodSetCost(float $price):bool;
            abstract public function deleteFoodItem():bool;
            public function getItems():string{
            
            
                return implode("," , $this->foodset->basicFoodSet);
            
            }
        


    }