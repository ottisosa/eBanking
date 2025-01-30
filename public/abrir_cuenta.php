<?php
require_once __DIR__ . "/assets/template/header.php";
?>


<section id="abrir-cuenta">
    <h2>Abrir una Nueva Cuenta</h2>
    <form class="form-style" id="newAccount">
        <div class="form-group">
            <div class="terms">
                <p>
                    Al abrir una nueva cuenta, usted acepta los siguientes términos y condiciones:
                    <ul>
                        <li>El banco puede modificar las tarifas y cargos según sea necesario.</li>
                        <li>El titular de la cuenta es responsable de mantener la confidencialidad de sus credenciales.</li>
                        <li>El banco no se hace responsable por transacciones no autorizadas si el titular no protege su información.</li>
                        <li>Se aplican cargos por sobregiro y otros servicios adicionales.</li>
                    </ul>
                    Para más detalles, consulte nuestro <a href="#">acuerdo completo de términos y condiciones</a>.
                </p>
            </div>
        </div>

        <div class="form-group">
            <label>
                <input type="checkbox" id="aceptar-terminos" name="aceptar-terminos" required>
                Acepto los términos y condiciones
            </label>
        </div>

        <div class="form-group">
            <button type="submit">Abrir Cuenta</button>
        </div>
    </form>
</section>

<script src="assets/js/newAccount.js"></script>

<?php
    require_once __DIR__ . "/assets/template/footer.php";
?>