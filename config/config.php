<?php
define("HOSTNAME", "mysql:host=localhost:3306;dbname=kickash");
define("USER_DB", "root");
define("PASSWORD", "jotadb7");

function conectar_db(){

    try {
        $con = new PDO(HOSTNAME, USER_DB, PASSWORD);  
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  

    } catch (PDOException $e) {
        header("Location: /error?error=Error en la conexión. Por favor, inténtelo de nuevo más tarde.");
        exit;
    }

    return $con;
}
