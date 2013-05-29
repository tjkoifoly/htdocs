<?php

header('Content-Type: application/json');
include 'connect_database.php';

$groupID = $_POST['groupID'];
$limit = $_POST['limit'];

function get_messages_group($gID, $lim) {
    if (connect_databse()) {

        if($lim == "")
        {
            $query = "SELECT *FROM message_group WHERE mgGroup=$gID 
            AND mgDateSent >= DATE_SUB(NOW(), INTERVAL 1 WEEK) 
            GROUP BY mgDateSent ORDER BY mgDateSent ASC;";
        }else
        {
            $query = "SELECT *FROM message_group WHERE mgGroup=$gID 
            AND mgDateSent > '$lim' 
            GROUP BY mgDateSent ORDER BY mgDateSent ASC;";
        }
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

echo get_messages_group($groupID, $limit);
?>
