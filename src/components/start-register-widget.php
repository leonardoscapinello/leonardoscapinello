<div class="white-box">

    <form action="<?= REGISTER_URL_SMALL_FORM_COOKIE ?>?small_campaign=Y">
        <div class="input_line">
            <label for="email">Seu nome</label>
            <input type="text" name="name" id="name" value="<?= $accountsTemporaryRegister->getName() ?>"
                   placeholder="">
        </div>
        <div class="input_line">
            <label for="email">Seu e-mail</label>
            <input type="text" name="email" id="email" value="<?= $accountsTemporaryRegister->getEmail() ?>"
                   placeholder="">
        </div>
        <div class="input_line">
            <label for="email">Seu WhatsApp</label>
            <input type="text" name="phone" id="phone" class="phone_with_ddd"
                   value="<?= $accountsTemporaryRegister->getPhone() ?>" placeholder="">
        </div>
        <div class="input_line">
            <p>Um Concierge entrará em contato com você por WhatsApp para te entregar nosso material exclusivo.</p>
        </div>
        <div class="input_line">
            <button class="btn btn--secondary">Criar Conta Gratuita</button>
        </div>
    </form>

</div>
                    