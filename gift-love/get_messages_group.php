<?php

header('Content-Type: application/json');
include 'connect_database.php';

$groupID = $_POST['groupID'];
$limit = isset($_POST['limit']) ? $_POST['limit'] : 50;

function get_messages_group($gID, $lim) {
    if (connect_databse()) {
        $sql = mysql_query("SELECT * FROM message_group WHERE mgGroup=$gID");
        $total = mysql_num_rows($sql);
        $start = 0;
        $end = $lim;
        if($total > $end)
        {
            $start = $total - $lim;
        }

        $query = "SELECT *FROM message_group WHERE mgGroup=$gID GROUP BY mgDateSent ORDER BY mgDateSent ASC LIMIT $start, $end;";

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
