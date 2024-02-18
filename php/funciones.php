<?php

    include 'databaseconnect.php';

    // Declaramos la conexión al servidor como variable global. 
    $conn = conexion_bd();

    // Evento para guardar el alta de los usuarios. 
    if(isset($_POST['registro'])){

        $nombre= $_POST ['registrarnombre'];
        $empleado= $_POST ['registrarempleado'];
        $rol= $_POST ['rol'];
        $clave= $_POST ['contra'];

        $insertarDatos = "INSERT INTO users VALUES ('$nombre','$empleado','$rol','$clave')";

        $ejecutarInsertar = mysqli_query ($conn,$insertarDatos);
    }

    // Evento para guardar el alta de los nuevos proyectos.
    if(isset($_POST['agregar_proyecto'])){

        $fecha_registro= $_POST ['fecha_alta'];
        $origen_peticion= $_POST ['origenpeticion'];
        $servicio= $_POST ['servicio'];
        $proyecto= $_POST ['nombreproyecto'];
        $descripcion= $_POST ['descripcion'];
        $tipo_proyecto= $_POST ['tipo_proyecto'];
        $clasificacion= $_POST ['clasipro'];
        $peticion= $_POST ['haypeti'];
        $arquitecto= $_POST ['arqui'];
        $programador= $_POST ['desarrollador'];
        $fecha_compromiso= $_POST ['fecha_compromiso'];

        $insertarDatos1 = "INSERT INTO proyectos_historica VALUES ('','$fecha_registro','$origen_peticion','$servicio','$proyecto','$descripcion','$tipo_proyecto','$clasificacion','$peticion','$arquitecto','$programador','','','','$fecha_compromiso','','')";
        $ejecutarInsertar = mysqli_query ($conn,$insertarDatos1);
    }