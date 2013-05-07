<?php

function connect_databse() {

    $host = "localhost:8889";
    $userMYSQL = 'root';
    $passwordMYSQL = 'foly';
    $database = 'gift-love-1';

    $conn = mysql_connect($host, $userMYSQL, $passwordMYSQL) or die(mysql_error());
    $db = mysql_select_db($database, $conn);
    
    return $db;
}

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}

function addhttp($url) {
    if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
        $url = "http://" . $url;
    }
    return $url;
}

?>
