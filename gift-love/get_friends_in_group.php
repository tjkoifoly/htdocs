<?php

header('Content-Type: application/json');
include 'connect_database.php';

$groupID = $_POST['gmID'];

function get_friends($gID) {
    if (connect_databse()) {
        $query = "SELECT * FROM account WHERE accID IN (SELECT group_people.gpMember FROM group_people WHERE group_people.gpGroup = $gID);";
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

echo get_friends($groupID);
?>