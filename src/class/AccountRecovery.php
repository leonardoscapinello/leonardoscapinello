<?php

class AccountRecovery
{

    private $id_recovery_token;
    private $id_account;
    private $token;
    private $insert_time;
    private $usernameExists = false;


    public function __construct($email_address)
    {
        global $database;
        global $token;
        if ($email_address !== null) {
            $database->query("SELECT id_account, phone_number, email, first_name FROM accounts WHERE username = ? OR email = ? AND is_active = 'Y'");
            $database->bind(1, $email_address);
            $database->bind(2, $email_address);
            $result = $database->resultsetObject();

            $tk = $token::tokenNumeric(6);

            if ($result && count(get_object_vars($result)) > 0) {

                $this->usernameExists = true;

                $database->query("INSERT INTO accounts_recovery_token (id_account, token) VALUES (?,?)");
                $database->bind(1, $result->id_account);
                $database->bind(2, md5($tk));
                $database->execute();

                $lid = $database->lastInsertId();
                if ($lid > 0) {
                    $this->id_recovery_token = $lid;
                    $this->notify($tk, $result->first_name, $result->phone_number, $result->email);
                }


            }else{
                $this->usernameExists = false;
            }
        }
    }


    private function notify($token, $first_name, $phone, $email)
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
            $emailNotification->button("Recuperar Minha Senha", RECOVERY_URL . "/code?c=" . ($token) . "&e=" . $text->base64_encode($email));
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




}
