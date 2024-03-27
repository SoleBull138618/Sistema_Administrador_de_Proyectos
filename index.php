<?php
include 'php/databaseconnect.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && filter_var($_POST['username'], FILTER_VALIDATE_INT)) {

    $user = $_POST['username'];
    $pass = $_POST['password'];

    $conexion_bd = conexion_bd();

    $insertarDatos = "SELECT empleado, rol FROM users WHERE empleado = '$user' AND clave = '$pass';";

    if ($conexion_bd) {

        $result = mysqli_query($conexion_bd, $insertarDatos);
        $row = mysqli_fetch_assoc($result);

        $_SESSION['user_id'] = $row['empleado'];
        $_SESSION['user_type'] = $row['rol'];

        switch (strtoupper($row['rol'])) {
            case '1':
                header('Location: user1.php');
                exit;
                break;
            case '2':
                header('Location: user2.php');
                exit;
                break;
            case '3':
                header('Location: user3.php');
                exit;
                break;
        }
    } else {
        echo '<div class="acceso_denegado">ACCESO DENEGADO</div>';
    };
}
?>


<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/index_style.css">
    <title>Ola</title>

    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/index.js"></script>

</head>

<body>
    <!-- Login -->
    <div class="contenedor">
        <form class="formulario" method="post">
            <h1 class="titulo">Bienvenido</h1>
            <div class="campos">
                <div class="campo__usuarios">
                    <input id="username" name="username" type="text" placeholder="N° Empleado" maxlength="8" required onlyNumber>
                    <!-- <img src="imagenes/user.png" alt="titulo" class="i_user"> -->
                </div>
                <div class="campo__contraseña">
                    <input id="contra_user" type="password" name="password" placeholder="Contraseña" required maxlength="15" minlength="8">
                    <img src="imagenes/help-circle-solid-24.png" alt="comentario" title="La contraseña debe tener:
- Máximo 15 dígitos.
- Mínimo 8 dígitos.
- 1 mayuscula y 1 numero." class="i">
                </div>
                <input id="btnValidaDatos" type="button" value="Validar">
                <input id="btnSubmit" type="submit" value="Login" style="display: none;">
            </div>
        </form>
</body>

</html> 