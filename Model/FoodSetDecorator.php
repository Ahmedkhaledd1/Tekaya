<?php
require_once 'FoodSet.php';
    abstract class FoodSetDecorator extends FoodSet{
            protected FoodSet $foodset;
            
        
            
            
            abstract public function updataItemCost(float $price):bool;
        
            public function getItems():string{
            
            
                return implode("," , $this->foodset->basicFoodSet);
            
            }
        


    }