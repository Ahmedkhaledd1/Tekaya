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

    public function changeState($donation): bool
    {
        return false; 
    }

}