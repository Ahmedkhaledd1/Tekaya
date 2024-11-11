<?php
    class Meat extends FoodSetDecorator{

        public function __construct(FoodSet $foodSet)
        {
            $this->foodset =$foodSet;

        }

        public function setFoodSet():bool 
        {
            $this->foodset->basicFoodSet[]="Meat";
            return true;
        }
        
        public function deleteFoodItem(): bool
        {
            $this->foodset->basicFoodSet=array_diff($this->foodset->basicFoodSet,["Meat"]);
            return true;
        }
        public function updataFoodSetCost(float $price): bool
        {
            
            $count=array_count_values($this->foodset->basicFoodSet);   
            $this->cost=$this->foodset->cost+($count["Meat"] ?? 0)*50;
            return true;

        }
        public function getCost():int
        {
        

            return $this->cost;
        }

    }