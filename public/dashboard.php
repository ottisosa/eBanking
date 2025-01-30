<?php
require_once __DIR__ . "/assets/template/header.php";
?>

<!-- Dashboard General -->
<section id="dashboard" class="dashboard">
    <h1>Resumen de Cuentas</h1>
    <div class="card-container" id="resumeAccounts">

    </div>
    <br>

    <h1>Resumen últimas Transacciones</h1>
    <div>
        <table class="table">
            <thead>
                <tr>
                    <th>Id Transacción</th>
                    <th>Cuenta Origen</th>
                    <th>Cuenta Destino</th>
                    <th>Fecha y Hora</th>
                    <th>Monto</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody id="transactionsList">
            </tbody>
        </table>
    </div>
</section>

<script src="./assets/js/dashboard.js"></script>

<?php
require_once __DIR__ . "/assets/template/footer.php";
?>