<?php

define('DB_SERVERNAME',"localhost");
define('DB_USERNAME', "root");
define('DB_PASSWORD', "root");
define('DB_NAME', "db-university-login");
define('DB_PORT', "3306");

try {

    $conn= new mysqli(DB_SERVERNAME, DB_USERNAME, DB_PASSWORD, DB_NAME, DB_PORT);
}catch(mysqli_sql_exception $e){    
    echo 'Errore di connessione al database: ' . $e->getMessage();
}

