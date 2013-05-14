<?php

header('Content-Type: application/json');
include 'connect_database.php';

$groupID = $_POST['groupID'];
$groupName= $_POST['groupName'];

function update_group_name($gID, $gname) {
    $result = array();
    if (connect_databse()) {
        $query = "UPDATE group_message SET gmName='$gname' WHERE gmID=$gID;";
        $result_update = mysql_query($query) or die(mysql_errno());
        if ($result_update) {

            $result[] = @"Insert Success";
        } else {
            $result[] = @"Insert Failed";
        }
        mysql_close();
        return json_encode($result);
    }
}

echo update_group_name($groupID, $groupName);

?>
