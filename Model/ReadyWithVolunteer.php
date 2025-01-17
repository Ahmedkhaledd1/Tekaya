<?php
require_once 'AbstractDonationState.php';

class ReadyWithVolunteer extends AbstractDonationState


{  
    public function __construct() {
        $this->setStateType('ReadyWithVolunteer');
        
    }
    public function changeState($donation): bool
    {
        if ($donation->getState()->getStateType=='ReadyWithVolunteer') {
            
            $donation->setStatus(new PendingBenefeciaryConfirm()); 
            return true; 
        }
        return false; 
    }

}