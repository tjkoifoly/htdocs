<?php

header('Content-Type: application/json');
include 'connect_database.php';

$giftID = $_POST['gfID'];

function open_gift($gID) {

    if (connect_databse()) {
        $query = "UPDATE gift SET gfMarkOpened=1 WHERE gfID=$gID;";

        $result_query = mysql_query($query) or die(mysql_errno());
        $row = array();

        if ($result_query) {
            $row[] = "Update success";
        } else {
            $row[] = "Update failed";
        }
        return json_encode($row);
        mysql_close();
    }
}

echo open_gift($giftID);
?>
