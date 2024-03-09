<?php

include 'php/databaseconnect.php';
session_start();

if (!isset($_SESSION['user_id']) || 
    strtoupper($_SESSION['user_type']) != '1') {
    header('Location: index.php');
    exit;
} else {
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/user_style.css">	
        <title>Administrador de Proyectos</title>
        <script src="js/script_user1.js"></script>
    </head>
    <body>
        <!-- Menú superior -->
        <div id="barra_sup" class="barra_sup">
            <form action='destruir_sesion.php'>
                <input class="arribita" type="submit" name="sesionDestroy" value="Cerrar sesion"/>
            </form>
            <!-- <input type="button" value="Cerrar Sesión" class="arribita"> -->
            <!-- <input type="button" value="Notificaciones" class="arribita"> -->
        </div> 
        
 
        <!-- Menú lateral izquierdo  -->
        <div class="container">

            <div id="sidebar" class="sidebar">
                <input id="btnAgregarUsuarios" type="button" value="Agregar Usuarios" class="menu">
                <input id="btnModificarUsuarios" type="button" value="Modificar Usuarios" class="menu">
                <input id="btnProyectos" type="button" value="Proyectos" class="menu">
                <input id="btnEstadisticas" type="button" value="Estadisticas" class="menu">
            </div> 

            <iframe id="framecito" name="nucleo"></iframe>

        </div>
    </body>
</html>