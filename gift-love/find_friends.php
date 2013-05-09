<?php

header('Content-Type: application/json');
include 'connect_database.php';

function find_friend() {
    $username = isset($_POST['username'])?$_POST['username']:"";
    $email = isset($_POST['email'])?$_POST['email']:"";
    $userIDFinder = intval( $_POST['finderID']);

    $query = "";
    if (!connect_databse()) {
        return NIL;
    } else {
        if ($username == "" && $email == "") {
            $query = "SELECT * FROM account WHERE accID NOT IN (SELECT rsFriendID From relationship WHERE rsSourceID = $userIDFinder) AND accID <> $userIDFinder LIMIT 100;";
        } elseif ($username != "" && $email == "") {
            $query = "SELECT * FROM account WHERE accName LIKE '%$username%' AND accID <> $userIDFinder LIMIT 100;";
        } elseif ($email != "" && $username == "") {
            $query = "SELECT * FROM account WHERE accEmail LIKE '%$email%' AND accID <> $userIDFinder LIMIT 100;";
        } else {
            return NIL;
        }

        //echo "$query";
        $result = mysql_query($query) or die(mysql_error());
        $num = mysql_num_rows($result);

        if ($num < 1) {
            return NIL;
        } else {
            $row = array();
            while ($row1 = mysql_fetch_assoc($result)) {
                $row[] = $row1;
            }
            return json_encode($row);
        }
        mysql_close();
    }
}

echo find_friend();

?>
