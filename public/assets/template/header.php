<?php
session_start();
if(!(isset($_SESSION['user_id'])) && !(isset($_SESSION['full_name']))){
    header("Location: http://localhost/eBanking/app/controllers/UserController.php?function=logout");}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard E-Banking</title>
    <link rel="stylesheet" href="../public/assets/css/index.css">
    <link rel="stylesheet" href="../public/assets/css/style.css">
</head>

<body>
    <!-- Barra lateral -->
    <aside class="sidebar">
        <div class="logo">
            <img src="./storage/images/logo.png">
        </div>
        <nav class="menu">
            <ul>
                <li><a href="./dashboard.php">Dashboard</a></li>
                <li><a href="./transferencia.php">Realizar Transferencias</a></li>
                <li><a href="./abrir_cuenta.php">Abrir Nueva Cuenta</a></li>
                <li><a href="./listado_cuentas.php">Listar Cuentas</a></li>
                <li><a href="./listado_transacciones.php">Listado de transacciones</a></li>
                <li><a href="./editar_perfil.php">Configuración</a></li>
            </ul>
        </nav>
        <div class="codedev-text">
            <p>Una compañia de</p>
            <p>CODEDEV UY Solutions</p>
        </div>
    </aside>

    <!-- Contenido principal -->
    <main class="main-content">
        <!-- Barra superior -->
        <header class="top-bar">
            <span class="user-detail">Bienvenido, <?php echo $_SESSION["full_name"]; ?></span>
            <div class="top-bar-icons">
                <span class="icon">🔔</span>
                <span class="icon">⚙️</span>
                <span class="icon"><a href="http://localhost/eBanking/app/controllers/UserController.php?function=logout">🚪</a></span>
            </div>
        </header>