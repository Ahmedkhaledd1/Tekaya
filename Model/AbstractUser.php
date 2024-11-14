<?php
abstract class AbstractUser
{
    protected string $id;
    protected string $email;
    protected string $password;
    protected Address $address;
    protected array $donations = [];
    protected string $mobile;

    public function __construct(string $email, string $password, string $mobile)
    {
        $this->email = $email;
        $this->password = $password;
        $this->mobile = $mobile;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getAddress()
    {
        return $this->address;
    }
    public function getDonations()
    {
        return $this->donations;
    }
    public function getMobile()
    {
        return $this->mobile;
    }
}
