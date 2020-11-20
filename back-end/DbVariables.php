<?php
    define("DB_HOST","localhost");
    define("DB_USER","root");
    define("DB_PASSWORD","");
    define("DB_NAME","technow");

    function getDSN($host=DB_HOST, $db_name=DB_NAME){
        return "mysql:host=$host;dbname=$db_name";
    }
?>