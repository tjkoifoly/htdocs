<?php

function connect_databse() {

    $host = "localhost:8889";
    $userMYSQL = 'root';
    $passwordMYSQL = 'foly';
    $database = 'gift-love';

    $conn = mysql_connect($host, $userMYSQL, $passwordMYSQL) or die(mysql_error());
    $db = mysql_select_db($database, $conn);
    
    return $db;
}

?>
