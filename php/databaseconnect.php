<?php
//Función para nuestra conexión. 
function conexion_bd(){
    $servername = "127.0.0.1";
    $database = "practicas";
    $username = "root";
    $password = "";

    $conn = mysqli_connect($servername, $username, $password, $database);
        

    return $conn;
}