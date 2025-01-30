<?php
require_once __DIR__ . "/assets/template/header.php";
?>


<!-- aqui inicia la pagina de transfrrencias -->
<section id="transferencias">
    <h2>Realizar Transferencia</h2>
    <form class="form-style" id="newTransfer">
        <div class="form-group">
            <label for="from_account_id">Cuenta Origen</label>
            <select id="from_account_id" name="from_account_id" required>
                <option value="">Seleccione su cuenta</option>
            </select>
        </div>

        <div class="form-group">
            <label for="to_account_id">Cuenta Destino</label>
            <input type="text" id="to_account_id" name="to_account_id" placeholder="Número de cuenta destino"
                required>
        </div>

        <div class="form-group">
            <label for="nombre-destinatario">Nombre Destinatario</label>
            <input type="text" id="nombre-destinatario" name="nombre-destinatario" placeholder="Nombre del destinatario" readonly>
        </div>

        <div class="form-group">
            <label for="description">Descripcion:</label>
            <input type="text" id="description" name="description" placeholder="Descripcion" required>
        </div>

        <div class="form-group">
        <label for="amount">Monto:</label>
        <input type="number" id="amount" name="amount" placeholder="1000" required>
        </div>

        <div class="form-group">
            <button type="submit">Enviar Transferencia</button>
        </div>
    </form>
</section>

<script src="assets/js/transfer.js"></script>

<?php
require_once __DIR__ . "/assets/template/footer.php";
?>