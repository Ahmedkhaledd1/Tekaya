<?php
require_once 'Donation.php';
interface IState
{
    public function changeState($donation):bool;

}