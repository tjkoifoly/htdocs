<?php

header('Content-Type: application/json');
include 'connect_database.php';

$senderID = $_POST['senderID'];
$groupID = $_POST['groupID'];

function post_message_group($sID, $gID, $msg, $type) {

    $result = array();
    if (connect_databse()) {
        
        $query = "INSERT INTO message_group VALUES (NULL, $sID, $gID, '$msg', NOW(), $type);";
        //echo "$query<br/>";

        $result_post = mysql_query($query) or die(mysql_errno());
        if ($result_post) {
            $result[] = @"Success";
        } else {
            $result[] = @"Failed";
        }
        mysql_close();
        return json_encode($result);
    }
}

echo post_message_group($senderID, $groupID, $_POST['mgMessage'], $_POST['mgType']);
?>
