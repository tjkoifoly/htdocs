<?php

header('Content-Type: application/json');
include 'connect_database.php';

$userID = $_POST['userID'];

function get_friend_request($uID)
{
    if(connect_databse())
    {
        $query = "SELECT DISTINCT account.*, relationship.rsID FROM relationship LEFT JOIN account ON rsSourceID = accID WHERE rsFriendID=$uID AND rsStatus=1;";
        $result_qerry = mysql_query($query) or die(mysql_error());
        $num = mysql_num_rows($result_qerry);

        if ($num < 1) {
            return NIL;
        } else {
            $row = array();
            while ($row1 = mysql_fetch_assoc($result_qerry)) {
                $row[] = $row1;
            }
            return json_encode($row);
        }
        mysql_close();
    }
}

echo get_friend_request($userID);

?>
