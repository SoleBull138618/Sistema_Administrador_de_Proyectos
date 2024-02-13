<!-- Guardar los usuarios registrados -->
<?php

    // Evento guardar el alta de los usuarios en bd. 
    if(isset($_POST['registro'])){

        $empleado= $_POST ['registrarempleado'];
        $nombre= $_POST ['registrarnombre'];
        $rol= $_POST ['rol'];
        $clave= $_POST ['contra'];

        $insertarDatos = "INSERT INTO users VALUES ('$empleado','$nombre','$rol','$clave')";

        $ejecutarInsertar = mysqli_query ($conn,$insertarDatos);
    }

?>
