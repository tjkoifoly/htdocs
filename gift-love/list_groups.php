<?php

header('Content-Type: application/json');
include 'connect_database.php';

$memeber = $_POST['memberID'];

function get_groups($mem) {
    if (connect_databse()) {
        $query = "SELECT group_message.*, COUNT(group_people.gpMember) as 'numbersMember' FROM group_message JOIN group_people ON group_message.gmID = group_people.gpGroup WHERE group_message.gmID IN(
SELECT group_message.gmID FROM group_message JOIN group_people ON group_message.gmID = group_people.gpGroup WHERE group_people.gpMember = $mem) GROUP BY group_people.gpGroup;";
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

echo get_groups($memeber);
?>
