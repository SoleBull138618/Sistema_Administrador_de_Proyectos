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
            guardar_proyectos();
            break;
        case 'info_tabla_proyectos':
            info_tabla_proyectos();
            break;
        case 'comentario_old_tabla_proyectos':
            comentario_old_tabla_proyectos();
             break;
        case 'actualizar_comentario_proyecto':
            actualizar_comentario_proyecto();
        case 'FiltrarProyecto':
            FiltrarProyecto();
            break;
    }

    // Evento para guardar el alta de los usuarios. 
    function guardar_usuarios(){

        global $conn;
        $nombre= $_POST ['registrarnombre'];
        $empleado= $_POST ['registrarempleado'];
        $rol= $_POST ['rol'];
        $clave= $_POST ['contra'];

        $estado = false;

        $insertarDatos = "INSERT INTO users VALUES ('$nombre','$empleado','$rol','$clave')";

        $ejecutarInsertar = mysqli_query ($conn,$insertarDatos);

        $estado = true;

        mysqli_close($conn);
        $salidaJSON = array('estado' => $estado);
        print json_encode($salidaJSON);
    }

    function guardar_proyectos(){

        global $conn;
        $proyecto= $_POST ['nombreproyecto'];
        $fecha_registro= $_POST ['fecha_alta'];
        $origen_peticion= $_POST ['origenpeticion'];
        $servicio= $_POST ['servicio'];
        $descripcion= $_POST ['descripcion'];
        $tipo_proyecto= $_POST ['tipo_proyecto'];
        $clasificacion= $_POST ['clasipro'];
        $peticion= $_POST ['haypeti'];
        $arquitecto= $_POST ['arqui'];
        $programador= $_POST ['desarrollador'];
        $fecha_compromiso= $_POST ['fecha_compromiso'];

        $insertarDatos1 = "INSERT INTO proyectos_historica VALUES ('','$proyecto','$fecha_registro','$origen_peticion','$servicio','$descripcion','$tipo_proyecto','$clasificacion','$peticion','$arquitecto','$programador','','','','$fecha_compromiso','','')";
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

                $html_info .= "<tr #empleado='#{$row['empleado']}'>";
                $html_info .= "<td>{$row["empleado"]}</td>";
                $html_info .= "<td>{$row["nombre"]}</td>";
                $html_info .= "<td>{$row["rol"]}</td>";
                $html_info .= "<td>{$row["clave"]}</td>";
                $html_info .= "<td data-manipulation-button='#{$row['empleado']}'><input id='btnBorrarUsuarios' type='button' value='Borrar' class='btnEliminarUsuarios'> <input id='btnEditarUsuarios' type='button' value='Editar' class='btnEditarUsuarios'></td>";
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

                $html_info .= "<tr id='project_{$row['id_proyecto']}'>";
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
                $html_info .= "<td data-manipulation-button='project_{$row['id_proyecto']}'><input type='button' value='Editar' class='btnEditarUsuarios'></td>";
                $html_info .= "</tr>";
            }
            
            $estado = true;
        }

        mysqli_close($conn);
        $salidaJSON = array('info_proyectos' => $html_info, 'estado' => $estado);
        print json_encode($salidaJSON);

    }      
    
    // Evento para consultar los comentarios de la tabla proyectos.
    function comentario_old_tabla_proyectos(){

        $id = $_POST['id'];

        global $conn;
        $query = "SELECT comentarios FROM proyectos_historica where id_proyecto='$id';";
        $html_info = '';
        $estado = false;

        if($result = mysqli_query($conn, $query)){

            while ($row = mysqli_fetch_assoc($result)){

                $allComentarios = explode('|', $row['comentarios']);

                foreach ($allComentarios as $newRow) {
                    $html_info .= "<tr>";
                    $html_info .= "<td>{$newRow}</td>";
                    $html_info .= "</tr>";
                }

            }
            
            $estado = true;
        }

        mysqli_close($conn);
        $salidaJSON = array('old_comentario' => $html_info, 'estado' => $estado);
        print json_encode($salidaJSON);

    }

    function actualizar_comentario_proyecto(){

        $update_avance_actual = $_POST ['update_avance_actual'];
        $update_comentarios= $_POST ['update_comentarios'];
        $old_comentarios= $_POST ['old_comentarios'];
        $id= $_POST ['id'];

        global $conn;
        
        $new_comentario = $old_comentarios.'|'.$update_comentarios;

        $insertarDatos = "UPDATE proyectos_historica SET avance_actual='$update_avance_actual',comentarios='$new_comentario' WHERE id_proyecto='$id'";

        $ejecutarInsertar = mysqli_query ($conn,$insertarDatos);

        $estado = true;

        mysqli_close($conn);
        $salidaJSON = array('estado' => $estado);
        print json_encode($salidaJSON);
    }      

    function FiltrarProyecto(){

        $filtrar_servicio = $_POST ['filtrar_servicio'];
        $filtrar_estatus= $_POST ['filtrar_estatus'];
        $filtrar_programador= $_POST ['filtrar_programador'];

        global $conn;
        $query = "SELECT id_proyecto, proyecto, fecha_registro, origen_peticion, servicio, descripcion, tipo_proyecto, clasificacion, peticion, arquitecto, programador, fecha_final, avance_actual,estatus,fecha_compromiso, comentarios, ultima_actualizacion FROM proyectos_historica WHERE servicio in($filtrar_servicio) and estatus in($filtrar_estatus) and programador in($filtrar_programador);";
        $html_info = '';
        $estado = false;
        

        if($result = mysqli_query($conn, $query)){

            while ($row = mysqli_fetch_assoc($result)){

                $html_info .= "<tr id='project_{$row['id_proyecto']}'>";
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
                $html_info .= "<td data-manipulation-button='project_{$row['id_proyecto']}'><input type='button' value='Editar' class='btnEditarUsuarios'></td>";
                $html_info .= "</tr>";
            }
            
            $estado = true;
        }

        mysqli_close($conn);
        $salidaJSON = array('info_proyectos' => $html_info, 'estado' => $estado);
        print json_encode($salidaJSON);

    }