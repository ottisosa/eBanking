<?php
require_once __DIR__ . "/assets/template/header.php";
?>


<section id="listadoTransacciones" class="listadoTransacciones">
            
            <h1>Resumen últimas Transacciones</h1>

            <div class="form-group">
            <label for="cuenta-seleccionada">Cuenta seleccionada</label>
            <select id="cuenta-seleccionada" name="cuenta-seleccionada" required>
                <option value="">Seleccione su cuenta</option>
            </select>
        </div>            <div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Id Transacción</th>
                            <th>Fecha y Hora</th>
                            <th>Monto</th>
                            <th>Emisor</th>
                            <th>Receptor</th>
                            <th>Descirpcion</th>
                            <th>Estado</th>
                            
                        </tr>
                    </thead>
                    <tbody id="listado-transacciones-table">
                    </tbody>
                </table>
            </div>
        </section>

        <script src="assets/js/transactionAccount.js"></script>
<?php
    require_once __DIR__ . "/assets/template/footer.php";
?>