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
            break;
        case 'actualizar_comentario_proyecto_arqui':
            actualizar_comentario_proyecto_arqui();
            break;
        case 'FiltrarProyecto':
            FiltrarProyecto();
            break;
        case 'GraficaPorServicio':
            GraficaPorServicio();
            break;
        case 'GraficaPorProgramador':
            GraficaPorProgramador();
            break;
        case 'GraficaPorEstatus':
            GraficaPorEstatus();
            break;
        case 'borrar_usuario':
            borrar_usuario();
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
        $estatus= $_POST ['estatus'];
        $comentario= $_POST ['comentarios'];
        
        $estado = false;

        $insertarDatos1 = "INSERT INTO proyectos_historica VALUES ('','$fecha_registro','$origen_peticion','$servicio','$proyecto','$descripcion','$tipo_proyecto','$clasificacion','$peticion','$arquitecto','$programador','','','$estatus','$fecha_compromiso','$comentario')";
        $ejecutarInsertar = mysqli_query ($conn,$insertarDatos1);

        $estado = true;

        mysqli_close($conn);
        $salidaJSON = array('estado' => $estado);
        print json_encode($salidaJSON);
    }
    
    // Evento para consultar todos los registros de la tabla usuarios.
    function info_tabla_usuarios(){

        global $conn;
        $query = "SELECT empleado, nombre, rol, clave FROM users;";
        $html_info = '';
        $estado = false;
        

        if($result = mysqli_query($conn, $query)){

            while ($row = mysqli_fetch_assoc($result)){

                $html_info .= "<tr empleado='n{$row['empleado']}'>";
                $html_info .= "<td>{$row["empleado"]}</td>";
                $html_info .= "<td>{$row["nombre"]}</td>";
                $html_info .= "<td>{$row["rol"]}</td>";
                $html_info .= "<td>{$row["clave"]}</td>";
                // $html_info .= "<td data-manipulation-button='n{$row['empleado']}'><input type='button' value='Borrar' class='btnEliminarUsuarios'></td>";
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
        $query = "SELECT id_proyecto, proyecto, fecha_registro, origen_peticion, servicio, descripcion, tipo_proyecto, clasificacion, peticion, arquitecto, programador, fecha_final, avance_actual,estatus,fecha_compromiso, comentarios FROM proyectos_historica;";
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

    // Evento para actualizar los proyectos del programardor o admin.
    function actualizar_comentario_proyecto(){

        $alta_fecha_final = $_POST ['alta_fecha_final'];
        $update_avance_actual = $_POST ['update_avance_actual'];
        $estatus_update = $_POST ['estatus_update'];
        $fecha_compromiso_update = $_POST ['fecha_compromiso_update'];
        $update_comentarios= $_POST ['update_comentarios'];
        $old_comentarios= $_POST ['old_comentarios'];
        $id= $_POST ['id'];

        global $conn;
        
        $new_comentario = $old_comentarios.'|'.$update_comentarios;

        $insertarDatos = "UPDATE proyectos_historica SET fecha_final='$alta_fecha_final',avance_actual='$update_avance_actual',estatus='$estatus_update',fecha_compromiso='$fecha_compromiso_update',comentarios='$new_comentario' WHERE id_proyecto='$id'";

        $ejecutarInsertar = mysqli_query ($conn,$insertarDatos);

        $estado = true;

        mysqli_close($conn);
        $salidaJSON = array('estado' => $estado);
        print json_encode($salidaJSON);
    }   
    
    // Evento para actualizar los proyectos del arqui.
    function actualizar_comentario_proyecto_arqui(){

        $alta_fecha_final = $_POST ['alta_fecha_final'];
        $update_avance_actual = $_POST ['update_avance_actual'];
        $estatus_update = $_POST ['estatus_update'];
        $fecha_compromiso_update = $_POST ['fecha_compromiso_update'];
        $update_comentarios= $_POST ['update_comentarios'];
        $old_comentarios= $_POST ['old_comentarios'];
        $id= $_POST ['id'];

        global $conn;
        
        $new_comentario = $old_comentarios.'|'.$update_comentarios;

        $insertarDatos = "UPDATE proyectos_historica SET fecha_final='$alta_fecha_final',avance_actual='$update_avance_actual',estatus='$estatus_update',fecha_compromiso='$fecha_compromiso_update',comentarios='$new_comentario' WHERE id_proyecto='$id'";

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
        $query = "SELECT id_proyecto, proyecto, fecha_registro, origen_peticion, servicio, descripcion, tipo_proyecto, clasificacion, peticion, arquitecto, programador, fecha_final, avance_actual,estatus,fecha_compromiso, comentarios FROM proyectos_historica WHERE servicio in($filtrar_servicio) and estatus in($filtrar_estatus) and programador in($filtrar_programador);";
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
                $html_info .= "<td data-manipulation-button='project_{$row['id_proyecto']}'><input type='button' value='Editar' class='btnEditarUsuarios'></td>";
                $html_info .= "</tr>";
            }
            
            $estado = true;
        }

        mysqli_close($conn);
        $salidaJSON = array('info_proyectos' => $html_info, 'estado' => $estado);
        print json_encode($salidaJSON);

    }

    function GraficaPorServicio(){

        global $conn;
        $query = "SELECT servicio, COUNT(*) as conteo FROM proyectos_historica GROUP by 1 order by 2 desc;";
        $html_info = array();
        $estado = false;
        

        if($result = mysqli_query($conn, $query)){
            
            while($row = mysqli_fetch_assoc($result)){
                array_push($html_info, array('name' => $row['servicio'], 'y' => intval($row['conteo'])));
            }

            $estado = true;
        }

        mysqli_close($conn);
        $salidaJSON = array('info_grafica_servicio' => $html_info, 'estado' => $estado);
        print json_encode($salidaJSON);
        
    }

    function GraficaPorProgramador(){

        global $conn;
        $query = "SELECT programador, COUNT(*) AS conteo FROM proyectos_historica GROUP BY 1 ORDER BY 2 DESC;";
        $html_info = array();
        $estado = false;
        

        if($result = mysqli_query($conn, $query)){
            
            while($row = mysqli_fetch_assoc($result)){
                array_push($html_info, array('name' => $row['programador'], 'y' => intval($row['conteo'])));
            }

            $estado = true;
        }

        mysqli_close($conn);
        $salidaJSON = array('info_grafica_programador' => $html_info, 'estado' => $estado);
        print json_encode($salidaJSON);
        
    }

    function GraficaPorEstatus(){

        global $conn;
        $query = "SELECT estatus, COUNT(*) as conteo FROM proyectos_historica GROUP BY 1 ORDER BY 2 DESC;";
        $html_info = array();
        $estado = false;
        

        if($result = mysqli_query($conn, $query)){
            
            while($row = mysqli_fetch_assoc($result)){
                array_push($html_info, array('name' => $row['estatus'], 'y' => intval($row['conteo'])));
            }

            $estado = true;
        }

        mysqli_close($conn);
        $salidaJSON = array('info_grafica_estatus' => $html_info, 'estado' => $estado);
        print json_encode($salidaJSON);
        
    }

    function borrar_usuario(){
       
        $id= $_POST ['id'];

        global $conn;
        
        $insertarDatos = "DELETE FROM users WHERE empleado='$id'";

        $ejecutarInsertar = mysqli_query ($conn,$insertarDatos);

        $estado = true;

        mysqli_close($conn);
        $salidaJSON = array('estado' => $estado);
        print json_encode($salidaJSON);
    }