<?php

    include 'databaseconnect.php';

    // Declaramos la conexión al servidor como variable global. 
    $conn = conexion_bd();

    $opc = $_POST['opc'];

    switch($opc){
        case 'info_tabla_usuarios':
            info_tabla_usuarios();
            break;
        case 'guardar_usuarios':
            guardar_usuarios();
            break;
        case 'guardar_proyectos':
            guardar_usuarios();
            break;
        case 'info_tabla_proyectos':
            info_tabla_proyectos();
            break;
    }

    function pruebaInfo(){

        echo "perrito";

    }

    // Evento para guardar el alta de los usuarios. 
    function guardar_usuarios(){

        global $conn;
        $nombre= $_POST ['registrarnombre'];
        $empleado= $_POST ['registrarempleado'];
        $rol= $_POST ['rol'];
        $clave= $_POST ['contra'];

        $insertarDatos = "INSERT INTO users VALUES ('$nombre','$empleado','$rol','$clave')";

        $ejecutarInsertar = mysqli_query ($conn,$insertarDatos);
    }

    // Evento para guardar el alta de los nuevos proyectos.
    function guardar_proyectos(){

        global $conn;
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
    
     // Evento para consultar todos los registros de la tabla usuarios.
    function info_tabla_usuarios(){

        global $conn;
        $query = "SELECT empleado, nombre, rol, clave FROM users;";
        $html_info = '';
        $estado = false;
        

        if($result = mysqli_query($conn, $query)){

            while ($row = mysqli_fetch_assoc($result)){

                $html_info .= "<tr>";
                $html_info .= "<td>{$row["empleado"]}</td>";
                $html_info .= "<td>{$row["nombre"]}</td>";
                $html_info .= "<td>{$row["rol"]}</td>";
                $html_info .= "<td>{$row["clave"]}</td>";
                $html_info .= "</tr>";
            }

            $estado = true;
        }

        mysqli_close($conn);
        $salidaJSON = array('info_empleado' => $html_info, 'estado' => $estado);
        print json_encode($salidaJSON);

    }

    // Evento para consultar todos los registros de la tabla proyectos.
    function info_tabla_proyectos(){

        global $conn;
        $query = "SELECT id_proyecto, proyecto, fecha_registro, origen_peticion, servicio, descripcion, tipo_proyecto, clasificacion, peticion, arquitecto, programador, fecha_final, avance_actual,estatus,fecha_compromiso, comentarios, ultima_actualizacion FROM proyectos_historica;";
        $html_info = '';
        $estado = false;
        

        if($result = mysqli_query($conn, $query)){

            while ($row = mysqli_fetch_assoc($result)){

                $html_info .= "<tr>";
                $html_info .= "<td>{$row["id_proyecto"]}</td>";
                $html_info .= "<td>{$row["proyecto"]}</td>";
                $html_info .= "<td>{$row["fecha_registro"]}</td>";
                $html_info .= "<td>{$row["origen_peticion"]}</td>";
                $html_info .= "<td>{$row["servicio"]}</td>";
                $html_info .= "<td>{$row["descripcion"]}</td>";
                $html_info .= "<td>{$row["tipo_proyecto"]}</td>";
                $html_info .= "<td>{$row["clasificacion"]}</td>";
                $html_info .= "<td>{$row["peticion"]}</td>";
                $html_info .= "<td>{$row["arquitecto"]}</td>";
                $html_info .= "<td>{$row["programador"]}</td>";
                $html_info .= "<td>{$row["fecha_final"]}</td>";
                $html_info .= "<td>{$row["avance_actual"]}</td>";
                $html_info .= "<td>{$row["estatus"]}</td>";
                $html_info .= "<td>{$row["fecha_compromiso"]}</td>";
                $html_info .= "<td>{$row["comentarios"]}</td>";
                $html_info .= "<td>{$row["ultima_actualizacion"]}</td>";
                $html_info .= "</tr>";
            }
            
            $estado = true;
        }

        mysqli_close($conn);
        $salidaJSON = array('info_proyectos' => $html_info, 'estado' => $estado);
        print json_encode($salidaJSON);

    }          