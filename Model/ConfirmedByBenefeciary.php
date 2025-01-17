<?php
require_once 'AbstractDonationState.php';

class ConfirmByBenefeciary extends AbstractDonationState


{  
    public function __construct() {
        $this->setStateType('ConfirmByBenefeciary');
        
    }
    public function changeState($donation): bool
    {
   
        return false; 
    }

}