<?php
require_once 'SubjectInterface.php';
class Donation implements SubjectInterface
{
    private string $title;
    private Benefeciary $benefeciary;
    private AbstractUser $donor;
    private DonationStrategyInterface $strategy;
    private bool $confirmReceived;
    private array $observers = [];

    public function __construct(string $title)
    {
        $this->title = $title;
    }

    public function setDonationStrategy(DonationStrategyInterface $strategy): bool
    {
        $this->strategy = $strategy;
        return true;
    }

    public function removeStrategy(): bool
    {
        $this->strategy = null;
        return true;
    }

    public function hasStrategy()
    {
        return $this->strategy;
    }

    public function excuteDonation(Benefeciary $benefeciary): bool
    {
        $this->strategy->deliverToBenefeciary($this, $benefeciary);
        if ($this->confirmReceived) {
            #notify observers that donation delivered successfully
            return true;
        }
        return false;
    }

    public function setConfirmReceived(Benefeciary $benefeciary)
    {
        $this->benefeciary = $benefeciary;
        $this->confirmReceived = true;
    }

    public function setDonor(Donor $donor)
    {
        $this->donor = $donor;
    }

    public function addObserver(ObserverInterface $ob)
    {
        array_push($this->observers, $ob);
    }

    public function removeObserver(ObserverInterface $ob)
    {
        array_pop($this->observers, $ob);
    }

    public function notifyObservers()
    {
        foreach ($this->observers as $ob) {
            $ob->update($this);
        }
    }

    public function __toString()
    {
        return "Title: ". $this->title ."\n email:" . $this->donor->getEmail() . "\nbenefec: " . $this->benefeciary->getEmail() . "\n strat: " . $this->strategy;
    }
}
