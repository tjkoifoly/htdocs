<?php

header('Content-Type: application/json');
include 'connect_database.php';

$userID = $_POST['userID'];
$groupID = $_POST['groupID'];

function leave_group($uID, $gID) {

    $result = array();
    if (connect_databse()) {
        
        $query = "DELETE FROM group_people WHERE gpMember=$uID AND gpGroup=$gID;";
        //echo "$query<br/>";

        $result_post = mysql_query($query) or die(mysql_errno());
        if ($result_post) {
            $result[] = @"Leave Success";
        } else {
            $result[] = @"Leave Failed";
        }
        mysql_close();
        return json_encode($result);
    }
}

echo leave_group($userID, $groupID);
?>
