<?php
require_once 'IState.php';
require_once 'Donation.php';
abstract class AbstractDonationState implements IState
{

    private string $stateType;
    public function setStateType($stateType){
        $this->stateType=$stateType;
    }
    public function getStateType(){
        return $this->stateType;
    }
    public function changeState($donation,$role): bool
    {
        return false; 
    }
}
