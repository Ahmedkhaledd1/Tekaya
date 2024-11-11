<?php
class SMSNotifier extends AbstractNotifier implements ObserverInterface
{
    private string $details;

    public function __construct(AbstractUser $user)
    {
        parent::__construct($user);
    }

    public function update(string $details): bool
    {
        $this->details = $details;
        return $this->notifyUser();
    }

    public function notifyUser(): bool
    {
        echo "<script>console.log('SMS Notifier: \n User: " . $this->getUser()->getMobile() . " \n Details: " . $this->details . "' );</script>";
        return true;
    }
}
