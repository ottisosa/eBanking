<?php
require_once __DIR__ . "/assets/template/header.php";
?>



<section id="listado-cuentas">
    <h2>Listado de Cuentas</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Número de Cuenta</th>
                <th>Saldo</th>
            </tr>
        </thead>
        <tbody id="accountsList">
        </tbody>
    </table>
</section>

<script src="assets/js/accountList.js"></script>
<?php
    require_once __DIR__ . "/assets/template/footer.php";
?>