<?php
    class Chicken extends FoodSetDecorator{

        public function __construct(FoodSet $foodSet)
        {
            $this->foodset =$foodSet;

        }

        public function setFoodSet():bool 
        {
            $this->foodset->basicFoodSet[]="Chicken";
            return true;
        }

        public function deleteFoodItem(): bool
        {
            $this->foodset->basicFoodSet=array_diff($this->foodset->basicFoodSet,["Chicken"]);
            return true;
        }
        public function updataFoodSetCost(float $price): bool
        {
            
            $count=array_count_values($this->foodset->basicFoodSet);   
            $this->cost=$this->foodset->cost+($count["Chicken"] ?? 0)*50;
            return true;

        }
        public function getCost():int
        {
        

            return $this->cost;
        }
        
    }