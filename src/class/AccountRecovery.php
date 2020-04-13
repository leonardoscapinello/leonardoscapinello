<?php

class AccountRecovery
{

    private $id_recovery_token;
    private $email_address;
    private $phone_number;
    private $first_name;
    private $token;
    private $id_account;
    private $usernameExists = false;


    public function __construct($email_address = null)
    {
        global $database;
        if ($email_address !== null) {
            $database->query("SELECT id_account, phone_number, email, first_name FROM accounts WHERE email = ? AND is_active = 'Y'");
            $database->bind(1, $email_address);
            $result = $database->resultsetObject();
            if ($result && count(get_object_vars($result)) > 0) {
                $this->usernameExists = true;
                $this->id_account = $result->id_account;
                $this->email_address = $result->email;
                $this->first_name = $result->first_name;
                $this->phone_number = $result->phone_number;
            }
        }
    }

    public function notify()
    {
        global $token;
        try {
            if ($this->email_address !== null && $this->email_address !== "") {
                $tk = $token::tokenNumeric(6);
                $this->registerRequest($tk);
                $this->sendEmailNotification($tk, $this->first_name, $this->phone_number, $this->email_address);
                return true;
            }
            return false;
        } catch (Exception $exception) {
            error_log($exception);
        }
    }

    public function validate($token)
    {
        global $database;
        if ($token !== null) {
            $database->query("SELECT token FROM accounts_recovery_token WHERE id_account = ? AND insert_time >= DATE_SUB(NOW(),INTERVAL 2 HOUR) ORDER BY insert_time DESC LIMIT 1");
            $database->bind(1, $this->id_account);
            $r = $database->resultset();
            if (count($r) > 0) {
                $cloud_token = $r[0]['token'];
                if ($cloud_token === md5($token)) {
                    return true;
                }
            }
        }
        return false;
    }


    private function registerRequest($token)
    {
        global $database;
        $lid = 0;
        if ($token !== null) {
            $database->query("INSERT INTO accounts_recovery_token (id_account, token) VALUES (?,?)");
            $database->bind(1, $this->id_account);
            $database->bind(2, md5($token));
            $database->execute();
            $lid = $database->lastInsertId();
            setcookie("LS_RECOVER_REQUEST", $lid, time() + 5400);
            if ($lid > 0) {
                $this->id_recovery_token = $lid;
            }
        }
        return $lid;
    }


    private function sendEmailNotification($token, $first_name, $phone, $email)
    {
        global $emailNotification;
        global $text;
        try {
            $emailNotification->subject("Precisando de ajuda com a Senha? Cheguei!");
            $emailNotification->preheader("Digite " . $token . " para recuperar sua senha no Portal LS");
            $emailNotification->paragraph("Aqui é o Leonardo.");
            $emailNotification->paragraph("Recebemos um pedido para recuperar sua senha. Para garantir sua segurança, estamos enviando esse código:");
            $emailNotification->paragraph("<b align='center'>" . $token . "</b>");
            $emailNotification->paragraph("É só digitar esse código na página do nosso portal ou clicar no botão abaixo:");
            $emailNotification->button("Recuperar Minha Senha", RECOVERY_URL . "/code?c=" . $text->base64_encode($token) . "&u=" . $text->base64_encode($email));
            $emailNotification->contact($first_name, $email);
            $emailNotification->send();
        } catch (Exception $exception) {
            error_log($exception);
        }
    }

    /**
     * @return mixed
     */
    public function getIdRecoveryToken()
    {
        return $this->id_recovery_token;
    }

    /**
     * @return bool
     */
    public function isUsernameExists(): bool
    {
        return $this->usernameExists;
    }

    /**
     * @return mixed
     */
    public function getIdAccount()
    {
        return $this->id_account;
    }


    public function hasAlreadyRequested()
    {
        if (isset($_COOKIE['LS_RECOVER_REQUEST'])) {
            return true;
        }
        return false;
    }

}
