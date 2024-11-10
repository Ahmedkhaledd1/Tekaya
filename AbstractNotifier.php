<?php
abstract class AbstractNotifier
{
    private AbstractUser $user;

    public function __construct(AbstractUser $user)
    {
        $this->user = $user;
    }

    public function notifyUser(): bool
    {
        # send sms msg to user
        $output = "";
        echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
        return true;
    }

    public function getUser()
    {
        return $this->user;
    }
}
