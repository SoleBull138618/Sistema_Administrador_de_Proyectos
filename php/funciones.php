<?php

    include 'databaseconnect.php';

    // Declaramos la conexión al servidor como variable global. 
    $conn = conexion_bd();

    // Evento para guardar el alta de los usuarios. 
    if(isset($_POST['registro'])){

        $empleado= $_POST ['registrarempleado'];
        $nombre= $_POST ['registrarnombre'];
        $rol= $_POST ['rol'];
        $clave= $_POST ['contra'];

        $insertarDatos = "INSERT INTO users VALUES ('$empleado','$nombre','$rol','$clave')";

        $ejecutarInsertar = mysqli_query ($conn,$insertarDatos);
    }

    // Evento para guardar el alta de los nuevos proyectos.
    if(isset($_POST['agregar_proyecto'])){

        $proyecto= $_POST ['nombreproyecto'];
        $fechaalta= $_POST ['fecha_alta'];
        $origen_peticion= $_POST ['origenpeticion'];
        $servicio= $_POST ['servicio'];
        $descripcion= $_POST ['descripcion'];
        $tipo_proyecto= $_POST ['tipo_proyecto'];
        $clasificacion= $_POST ['clasipro'];
        $peticion= $_POST ['haypeti'];
        $arquitecto= $_POST ['arqui'];
        $desarrollador= $_POST ['desarrollador'];
        $compromiso= $_POST ['fecha_compromiso'];

        $insertarDatos = "INSERT INTO proyectos VALUES ('','$proyecto','$fechaalta','$origen_peticion','$servicio','$descripcion','$tipo_proyecto','$clasificacion','$peticion','$arquitecto','$desarrollador','$compromiso')";

        $ejecutarInsertar = mysqli_query ($conn,$insertarDatos);
    }