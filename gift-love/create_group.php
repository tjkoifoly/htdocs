<?php

header('Content-Type: application/json');
include 'connect_database.php';

$creatorID = $_POST['creatorID'];

function create_group($cID) {
    if (connect_databse()) {
        $query = "INSERT INTO group_message VALUES (NULL, '');";
        $result_insert = mysql_query($query) or die(mysql_errno());
        if ($result_insert) {
            //$result[] = @"Insert group Success";
            $gID = mysql_insert_id();
            $query = "INSERT INTO group_people VALUES ($gID,$cID);";
            $result_insert = mysql_query($query) or die(mysql_errno());
            if ($result_insert) {
                //$result[] = @"Insert member Success";
                $query = "SELECT * FROM group_message WHERE gmID=$gID;";
                $result_query = mysql_query($query) or die(mysql_errno());

                $num = mysql_num_rows($result_query);

                if ($num < 1) {
                    return NIL;
                } else {
                    $row = array();
                    while ($row1 = mysql_fetch_assoc($result_query)) {
                        $row[] = $row1;
                    }
                    return json_encode($row);
                }
            } else {
                //$result[] = @"Insert member Failed";
            }
        } else {
            //$result[] = @"Insert Failed";
        }
        mysql_close();
        return NIL;
    }
}

echo create_group($creatorID);
?>
