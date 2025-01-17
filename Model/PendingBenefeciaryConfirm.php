<?php
require_once 'AbstractDonationState.php';

class PendingBenefeciaryConfirm extends AbstractDonationState


{  
    public function __construct() {
        $this->setStateType('PendingBenefeciaryConfirm');
        
    }
    public function changeState($donation): bool
    {
        if ($donation->getState()->getStateType=='PendingBenefeciaryConfirm') {
            
            $donation->setStatus(new ConfirmByBenefeciary()); 
            return true; 
        }
        return false; 
    }

}