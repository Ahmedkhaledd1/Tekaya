<?php
class DonationProxy implements IState
{

    private AbstractDonationState $donationState;
    public function getDonationState()
    {
        return $this->donationState;
    }

    public function setDonationState( $donationState)
    {
        $this->donationState = $donationState;
    }

    public function changeState($donation,$role): bool
    {

        if($role=='Admin'){
            if($this->donationState->getStateType()!="ReadyWithVolunteer"&&$this->donationState->getStateType()!="PendingBenefeciaryConfirm")
            $this->donationState->changeState($donation,$role);
            else
            return false; 
        }elseif($role=='Volunteer'){
            if($this->donationState->getStateType()=="ReadyWithVolunteer")
            $this->donationState->changeState($donation,$role);
            else
            return false; 
        }elseif($role=='Benefeciary'){
            if($this->donationState->getStateType()!="PendingBenefeciaryConfirm")
            $this->donationState->changeState($donation,$role);
            else
            return false; 
        }
        return false; 
    }

}