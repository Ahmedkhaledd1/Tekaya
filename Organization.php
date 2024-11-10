<?php
class Organization extends AbstractUser
{
    private string $title;
    private OrgType $orgType;
    private string $taxNumber;

    public function __construct(string $email, string $password, string $mobile, string $title, OrgType $orgType, string $taxNumber,)
    {
        parent::__construct($email, $password, $mobile);
        $this->title = $title;
        $this->taxNumber = $taxNumber;
        $this->orgType = $orgType;
    }
    public function addDonation(Donation $donation) {}
}

enum OrgType
{
    case restaurant;
    case shop;
}
