<?php
require_once 'AbstractDonationState.php';

class AssignedToBenefeciary extends AbstractDonationState


{  
    public function __construct() {
        $this->setStateType('AssignedToBenefeciary');
        
    }
    public function changeState($donation,$role): bool
    {
        if ($donation->getState()->getStateType=='AssignedToBenefeciary') {
            
            $donation->setStatus(new ReadyWithVolunteer()); 
            return true; 
        }
        return false; 
    }

}