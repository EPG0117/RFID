<?php

    $servidor = "127.0.0.1"; //* 127.0.0.1
    $baseDeDatos = "app";
    $port = "3307";
    $usuario = "root";
    $contrasena = "";

    try {
        $conexion = new PDO("mysql:host=$servidor;
                            dbname=$baseDeDatos;
                            dbport=$port",
                            $usuario,
                            $contrasena);
    } catch(Exception $ex) {
        echo $ex->getMessage();
    }
?>