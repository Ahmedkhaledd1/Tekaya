<?php
require_once 'AbstractDonationState.php';
require_once 'AssignedToBenefeciary.php';
class NotAssignedToBenefeciary extends AbstractDonationState


{  
    public function __construct() {
        $this->setStateType('NotAssignedToBenefeciary');
        
    }
    public function changeState($donation,$role): bool
    {
        if ($donation->getState()->getStateType=='NotAssignedToBenefeciary') {
            // Logic to transition to the next state (e.g., 'Approved')
            $donation->setStatus(new AssignedToBenefeciary()); 
            return true; 
        }
        return false; 
    }

}