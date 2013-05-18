<?php

header('Content-Type: application/json');
include 'connect_database.php';

$userID = $_POST['userID'];

function get_list_gift($uID)
{
    $result = array();
    if(connect_databse())
    {
        $query_inbox = "(SELECT * FROM gift WHERE (gfRecieverID=$uID AND gfDateSent <= NOW())) UNION (SELECT * FROM gift WHERE gfSenderID=$uID);";
        $result_inbox = mysql_query($query_inbox) or die(mysql_error());
        $num = mysql_num_rows($result_inbox);
        if ($num < 1) {
            $result = NIL;
        } else {
            while ($row1 = mysql_fetch_assoc($result_inbox)) {
                $result[] = $row1;
            }
            
        }
        mysql_close();
        return json_encode($result);
    }
}

echo get_list_gift($userID);
?>
