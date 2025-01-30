<?php
require_once __DIR__ . "/assets/template/header.php";
?>



<section id="editar-perfil">
    <h2>Editar Perfil del Usuario</h2>
    <form class="form-style">
        <div class="form-group">
            <label for="nombre-completo">Nombre Completo</label>
            <input type="text" id="nombre-completo" name="nombre-completo" placeholder="Nombre Completo" required>
        </div>

        <div class="form-group">
            <label for="nombre-usuario">Nombre de Usuario</label>
            <input type="text" id="nombre-usuario" name="nombre-usuario" placeholder="Nombre de Usuario" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Email" required>
        </div>

        <div class="form-group">
            <label for="telefono">Teléfono</label>
            <input type="tel" id="telefono" name="telefono" placeholder="Teléfono" required>
        </div>

        <div class="form-group">
            <button type="submit">Guardar Cambios</button>
        </div>
    </form>
</section>
<br>
<section id="restablecer-contrasena">
    <h2>Restablecer Contraseña</h2>
    <form class="form-style" id="changePassword">
        <div class="form-group">
            <label for="current_password">Contraseña Actual</label>
            <input type="password" id="current_password" name="current_password" placeholder="Contraseña Actual" required>
        </div>

        <div class="form-group">
            <label for="new_password">Nueva Contraseña</label>
            <input type="password" id="new_password" name="new_password" placeholder="Nueva Contraseña" required>
        </div>

        <div class="form-group">
            <label for="confirm_password">Confirmar Nueva Contraseña</label>
            <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirmar Nueva Contraseña" required>
        </div>

        <div class="form-group">
            <button type="submit">Restablecer Contraseña</button>
        </div>
    </form>
</section>

<script src="assets/js/profile.js"></script>
<?php
    require_once __DIR__ . "/assets/template/footer.php";
?>