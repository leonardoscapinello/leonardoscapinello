<?php

class Campaign
{

    private $full_name;
    private $email_address;
    private $phone_number;
    private $campaign = "SD_SOBREVIVAAOCORONA";

    /**
     * @return mixed
     */
    public function getFullName()
    {
        return $this->full_name;
    }

    /**
     * @param mixed $full_name
     */
    public function setFullName($full_name)
    {
        $this->full_name = base64_encode($full_name);
    }

    /**
     * @return mixed
     */
    public function getEmailAddress()
    {
        return $this->email_address;
    }

    /**
     * @param mixed $email_address
     */
    public function setEmailAddress($email_address)
    {
        $this->email_address = base64_encode($email_address);;
    }

    /**
     * @return mixed
     */
    public function getPhoneNumber()
    {
        return $this->phone_number;
    }

    /**
     * @param mixed $phone_number
     */
    public function setPhoneNumber($phone_number)
    {
        $this->phone_number = base64_encode($phone_number);;
    }


    public function store()
    {
        $database = new Database();
        if ($this->getFullName() !== null) {
            if ($this->getEmailAddress() !== null) {

                $database->query("INSERT INTO leads (full_name, email_address, phone_number, campaign) VALUES (?,?,?,?)");
                $database->bind(1, $this->getFullName());
                $database->bind(2, $this->getEmailAddress());
                $database->bind(3, $this->getPhoneNumber());
                $database->bind(4, $this->campaign);
                $database->execute();

            }
        }
    }


}