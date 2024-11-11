<?php
abstract class AbstractFoodSet  implements DonationStrategyInterface
{
    private string $description;
    private float $cost;

    public function getItems(): string
    {
        return $this->description;
    }

    public function deliverToBenefeciary(Donation $donation, Benefeciary $benefeciary): bool
    {
        return $benefeciary->confirmReceivedDonation($donation);
    }
}
